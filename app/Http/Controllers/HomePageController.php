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


    public function index()
    {
        $categories = Category::all()->toArray();
        return Inertia::render('User/Components/Navbar', [
            'categories' => $categories
        ]);
    }

    public function homePage()
    {
        $carousel_images = CarouselImage::select('id', 'name as image')->get();
        $categories = Category::get();
        $products = Product::where('is_active', 1)->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->get();

        if (Auth::check()) {
            $cartData = Cart::where('user_id', Auth::user()->id)->with(['product' => function ($query) {
                $query->with('images');
            }])->get();

            foreach ($cartData as $product) {
                foreach ($product->product->images as $image) {
                    $image->image = asset('storage/images/' . $image->image);
                }
            }
        }

        $payments = Payment::where('is_active', 1)->get();

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
            'carouselImages' => $carousel_images,
            'cartData' => $cartData ?? [],
            'payments' => $payments,
            'is_auth' => Auth::check()
        ]);
    }
}
