<?php

namespace App\Http\Controllers;

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
        return Inertia::render('Admin/Product/Create');
    }

    public function store(Request $request)
    {
        dd($request);
    }
}
