<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomePageController extends Controller
{
    public function homePage()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->get();

        foreach ($categories as $category) {
            $category->image = asset('storage/images/' . $category->image);
        }
        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return Inertia::render('User/Home', [
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
