<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct(protected Product $model) {}

    public function detail($id)
    {
        $product = Product::with('images')->findorFail($id);
        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }
        return Inertia::render('User/Detail', ['product' => $product]);
    }

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
        $trendingProducts = $this->model->where('view_count', '>', 0)
            ->orderBy('view_count', 'desc')->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->limit(4)->get();

        foreach ($trendingProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }


        return inertia('User/TrendingProduct', ['trending_products' => $trendingProducts]);
    }

    public function popular()
    {
        $popularProducts = $this->model->orderBy('order_count', 'desc')->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->limit(4)->get();

        foreach ($popularProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return inertia('User/PopularProduct', ['popular_products' => $popularProducts]);
    }

    public function recommend()
    {

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

        $products = Product::whereIn('category_id', $categoryIds)->with('category')
            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->limit(4)->get();

        foreach ($products as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }

        return inertia('User/RecommendProduct', ['recommend_products' => $products]);
    }

    public function new_arrival()
    {
        $lastWeekDate = Carbon::now()->subWeek();
        $newArrivalProducts = $this->model->whereDate('created_at', '>=', $lastWeekDate)->with('category')->orderBy('created_at', 'desc')

            ->when(Auth::user(), function ($query) {
                $query->withCount(['wish_lists as is_favorite' => function ($query) {
                    $query->where('user_id', Auth::user()->id);
                }]);
            })
            ->with('images')->limit(4)->get();

        foreach ($newArrivalProducts as $product) {
            foreach ($product->images as $image) {
                $image->image = asset('storage/images/' . $image->image);
            }
        }


        return inertia('User/NewArrivalProduct', ['new_arrival_products' => $newArrivalProducts]);
    }

    //discount product
    public function discount()
    {
        $discountProducts = Product::whereNotNull('discount_price')
            ->where('discount_price', '>', 0)
            ->with('category')
            ->with('images')
            ->get();
        foreach ($discountProducts as $product) {
            $product->image = asset('storage/images/' . $product->image);
        }
        return inertia('User/DiscountProduct', ['discount_products' => $discountProducts]);
    }

    //product view count
    public function viewCount($id)
    {
        $product = $this->model->find($id);
        $product->increment('view_count');
    }
}
