<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService, protected Product $product) {}

    public function index()
    {
        $products = $this->product->with('category', 'images')->get();
        foreach ($products as $product) {
            foreach ($product->images as $image) {
               $image->image = asset('storage/images/' . $image->image);
            }
        }
        return Inertia::render('Admin/Product/Index', ['products' => $products]);
    }

    public function create()
    {
        $categories = Category::get();
        return Inertia::render('Admin/Product/Create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'category_id' => 'required',
        //     'name' => 'required',
        //     'price' => 'required',
        //     'discount_price' => 'required',
        //     'description' => 'required',
        //     'is_active' => 'required',
        // ]);
        $this->productService->create($request);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->product->with('images')->find($id);
        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }
        $product->save();
        $categories = Category::get();
        return Inertia::render('Admin/Product/Edit', ['product' => $product, 'categories' => $categories]);
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index');
    }
}
