<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected Cart $model) {}

    public function cartPage()
    {
        return Inertia::render('User/Cart');
    }
}
