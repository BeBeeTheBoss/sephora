<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User; // User model import
use App\Models\Order; // Order model import
use App\Models\Product; // Product model import
use Illuminate\Support\Facades\Auth;

class HubSpotWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // Webhook data ကို Log ထဲမှာ သိမ်းပါ
        Log::info('HubSpot Webhook Event:', $request->all());

        // Webhook Event ကို process လုပ်ပါ
        foreach ($request->all() as $event) {
            $eventType = $event['subscriptionType'] ?? '';

            switch ($eventType) {
                case 'object.creation':
                    // Contact Created
                    $this->handleContactCreated($event);
                    break;

                // Add more cases as needed

                default:
                    Log::warning('Unhandled event type: ' . $eventType);
                    break;
            }
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleContactCreated($event)
    {
        $contactId = $event['objectId'];

        // User ကို HubSpot မှ contact ID အပေါ်မူတည်ပြီး ဖျော်ဖြေရန်
        $user = User::where('hubspot_contact_id', $contactId)->first(); // hubspot_contact_id ကို သုံးပါ

        if ($user) {
            // User ရှိလျှင် recommend() function ကို ခေါ်ပါ
            return $this->recommend($user);
        }

        Log::warning('User not found for HubSpot contact ID: ' . $contactId);
    }

    public function recommend(User $user) // User ကို parameter အနေဖြင့် သတ်မှတ်ပါ
    {
        $categoryIds = Order::where('user_id', $user->id)
            ->whereHas('order_products', function ($query) {
                $query->whereHas('product', function ($productQuery) {
                    $productQuery->whereNotNull('category_id');
                });
            })
            ->with(['order_products.product' => function ($query) {
                $query->select('id', 'category_id');
            }])
            ->limit(4)
            ->get()
            ->pluck('order_products.*.product.category_id')
            ->flatten()
            ->unique();

        $products = Product::whereIn('category_id', $categoryIds)->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->get();

        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        // Inertia.js က အချက်အလက်ကို ပြန်ပေးပါ
        return inertia('User/RecommendProduct', ['recommend_products' => $products]);
    }
}
