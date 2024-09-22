<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishListController extends Controller
{
    public function __construct(protected WishList $model) {}

    public function index()
    {
        return Inertia::render('User/WishList');
    }

    public function store(Request $request)
    {

        if (!Auth::user()) {
            session(['failed' => 'Please login first']);
            return redirect()->back();
        }

        dd($request->all());
        $this->model->create([
            'product_id' => $request->product_id,
            'user_id' => auth()->user()->id
        ]);
        return redirect()->back();
    }
}
