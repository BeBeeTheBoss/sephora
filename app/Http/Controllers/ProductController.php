<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}

    public function index()
    {
        return Inertia::render('Admin/Product/Index');
    }

    public function create()
    {
        $categories = Category::get();
        return Inertia::render('Admin/Product/Create', ['categories' => $categories]);
    }

    public function store(Request $request) {}
}
