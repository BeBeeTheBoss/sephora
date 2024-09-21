<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected Product $model) {}

    public function show()
    {
        return Inertia::render('User/ProductDetails');
    }
}
