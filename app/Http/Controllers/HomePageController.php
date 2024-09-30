<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CarouselImage;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function homePage()
    {
        $carousel_images = CarouselImage::select('id', 'name as image')->get();
        $categories = Category::withCount('products')->get();
        $products = Product::where('is_active', 1)->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->get();

        $products = Cart::where('user_id', Auth::user()->id)->with(['product' => function ($query) {
            $query->with('images');
        }])->get();

        $payments = Payment::where('is_active', 1)->get();

        foreach ($products as $product) {
            foreach ($product->product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        foreach ($categories as $category) {
            $category->image = asset('storage/images/' . $category->image);
        }
        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }
        foreach ($carousel_images as $carousel_image) {
            $carousel_image->image = asset('storage/images/' . $carousel_image->image);
        }

        return Inertia::render('User/Home', [
            'categories' => $categories,
            'products' => $products,
            'carouselImages' => $carousel_images
        ]);
    }
}
