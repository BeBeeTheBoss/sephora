<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function __construct(protected WishList $model) {}

    public function index()
    {
        if (!Auth::user()) {
            session(['failed' => 'Please login first']);
            return redirect()->back();
        }

        $wishLists = $this->model->where('user_id', Auth::user()->id)->pluck('product_id')->toArray();
        $allWishlistProducts = Product::whereIn('id', $wishLists)->with('category', 'images')->get();

        $products = $allWishlistProducts->where('is_active', 1)->values();

        $inactiveProducts = $allWishlistProducts->where('is_active', 0)->values();
        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        if ($inactiveProducts->isNotEmpty()) {
            $notificationMessage = "Products are stock";
        }

        return Inertia::render('User/WishList', [
            'products' => $products,
            'inactiveProducts' => $inactiveProducts,
            'notificationMessage' => $notificationMessage ?? null,
        ]);
    }
}
