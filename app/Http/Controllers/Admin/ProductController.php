<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

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
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,webp'

        ]);
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

    public function update(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'delete_images' => 'nullable|array', // Assuming images is the name of your images table
        ]);

        $this->productService->update($request);
        return to_route('products.index');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index');
    }
}
