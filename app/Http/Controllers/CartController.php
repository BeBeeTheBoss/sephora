<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Payment;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct(protected Cart $model) {}

    public function index()
    {
        if(!Auth::check()){
            session(['failed' => 'Please login first']);
            return back();
        }
        $products = $this->model->where('user_id',Auth::user()->id)->with(['product' => function($query){
            $query->with('images');
        }])->get();

        $payments = Payment::get();

        foreach($products as $product){
            foreach($product->product->images as $image){
                $image->image = asset('storage/images/'.$image->image);
            }
        }

        return Inertia::render('User/Cart',[
            'products' => $products,
            'payments' => $payments
        ]);
    }

    public function store(Request $request){

        if(!Auth::check()){
            session(['failed' => 'Please login first']);
            return back();
        }

        $this->model->create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        session(['success' => 'Product added to cart']);
        return back();
    }
}
