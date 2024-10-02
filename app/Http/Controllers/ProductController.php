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
        if (!Auth::check()) {
            session(['failed' => 'Please login first']);
            return back();
        }

        $categoryIds = Order::where('user_id', Auth::id())
            ->whereHas('order_products', function ($query) {
                $query->whereHas('product', function ($productQuery) {
                    $productQuery->whereNotNull('category_id');
                });
            })
            ->with(['order_products.product' => function ($query) {
                $query->select('id', 'category_id');
            }])
            ->get()
            ->pluck('order_products.*.product.category_id')
            ->flatten()
            ->unique();

        $products = Product::whereIn('category_id', $categoryIds)
            ->get();
        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }
        return inertia('User/RecommendProduct', ['recommend_products' => $products]);
    }

    public function new_arrival()
    {
        $newArrivalProducts = $this->model->orderBy('created_at', 'desc')->get(); // By Date
        foreach ($newArrivalProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return inertia('User/NewArrivalProduct', ['new_arrival_products' => $newArrivalProducts]);
    }

    //product view count
    public function viewCount($id)
    {
        $product = $this->model->find($id);
        $product->increment('view_count');
    }
}
