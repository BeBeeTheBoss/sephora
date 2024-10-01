<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(protected Product $model) {}

    public function show($id)
    {
        $product = $this->model->with('category:id,name')->with('images')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->find($id);

        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }

        return Inertia::render('User/ProductDetails', [
            'product' => $product
        ]);
    }

    public function trending()
    {
        $trendingProducts = $this->model->orderBy('view_count', 'desc')->with('images')->get(); // By View
        foreach ($trendingProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return inertia('User/TrendingProduct', ['trending_products' => $trendingProducts]);
    }

    public function popular()
    {
        $popularProducts = $this->model->orderBy('order_count', 'desc')->get(); // By Order
        foreach ($popularProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return inertia('User/PopularProduct', ['popular_products' => $popularProducts]);
    }

    public function recommend()
    {
        // $products = Order::where('user_id', Auth::id())  // Retrieve orders for the current user
        //     ->whereHas('order_products', function ($query) {
        //         $query->whereHas('product', function ($productQuery) {
        //             $productQuery->
        //         });
        //     })
        //     ->with('order_products.product')  // Eager load the related products for performance
        //     ->get();
        // dd($products);
        // return inertia('User/recommendProduct',['recommend_products' => ]);
    }

    //product view count
    public function viewCount($id)
    {
        $product = $this->model->find($id);
        $product->increment('view_count');
    }
}
