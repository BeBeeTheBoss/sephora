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
        if(!Auth::user()){
            session(['failed' => 'Please login first']);
            return redirect()->back();
        }

        $wishLists = $this->model->where('user_id',Auth::user()->id)->pluck('product_id')->toArray();

        $products = Product::where('is_active',1)->whereIn('id', $wishLists)->with('category')
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

        return Inertia::render('User/WishList',[
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {

        if (!Auth::user()) {
            session(['failed' => 'Please login first']);
            return redirect()->back();
        }

        $wishList = $this->model->where('product_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
        if ($wishList) {
            $wishList->delete();
            session(['success' => 'Product removed from wishlist']);
            return redirect()->back();
        }

        $this->model->create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id
        ]);
        session(['success' => 'Product added to wishlist']);
        return redirect()->back();
    }
}
