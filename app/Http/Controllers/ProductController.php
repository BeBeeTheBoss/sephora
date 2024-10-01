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
}
