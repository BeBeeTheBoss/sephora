<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DetailController extends Controller
{
    //
    public function detail($id)
    {
        $product = Product::findOrFail($id)->with('images');
        foreach ($product->images as $image) {
            $image->image = asset('storage/product-images/' . $image->image);
        }
        return Inertia::render('User/Detail', ['product' => $product]);
    }
}
