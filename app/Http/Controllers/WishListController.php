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
        if (!Auth::check()) {
            session(['failed' => 'Please login first']);
            return redirect()->back();
        }
        $userId = Auth::id();

        $wishListItems = $this->model
            ->where('user_id', $userId)
            ->get();

        $wishListProductIds = $wishListItems->pluck('product_id')->toArray();

        $allWishlistProducts = Product::whereIn('id', $wishListProductIds)
            ->where('is_active', 1)
            ->with(['category', 'images'])
            ->get();

        $products = $allWishlistProducts->map(function ($product) use ($userId, $wishListItems) {
            $product->images->each(function ($image) {
                $image->image = asset('storage/images/' . $image->image);
            });

            $product->userWishList = $wishListItems->firstWhere('product_id', $product->id);

            return $product;
        });


        return Inertia::render('User/WishList', [
            'products' => $products,
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

        $product = Product::find($request->product_id);
        $product->increment('favourite_count');
        session(['success' => 'Product added to wishlist']);
        return redirect()->back();
    }
}
