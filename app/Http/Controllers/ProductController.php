<?php

namespace App\Http\Controllers;

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

        foreach($product->images as $image){
            $image->image = asset('storage/images/'.$image->image);
        }

        return Inertia::render('User/ProductDetails',[
            'product' => $product
        ]);
    }

    public function trending(){
        $trendingProducts = $this->model->where('view_count','desc')->get();
        return inertia('User/TrendingProduct',['trending_products' => $trendingProducts]);
    }

    public function popular(){
        $popularProducts = $this->model->where('order_count','desc')->get();
        return inertia('User/PopularProduct',['popular_products' => $popularProducts]);
    }

    public function recommend(){
        // return inertia('User/recommendProduct',['recommend_products' => ]);
    }

    //product view count
    public function viewCount($id){
        $product = $this->model->find($id);
        $product->increment('view_count');
    }
}
