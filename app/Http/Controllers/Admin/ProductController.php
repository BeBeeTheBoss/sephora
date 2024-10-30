<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Product;
use App\Models\Category;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService, protected Product $model) {}

    public function index()
    {
        $products = $this->model->with('category', 'images')->get();
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
            'discount_price' => 'nullable',
            'images.*' => 'nullable|mimes:jpg,jpeg,png,webp'
        ]);
        $this->productService->create($request);
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $product = $this->model->find($id);
        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }
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
            'delete_images' => 'nullable|array',
        ]);

        $this->productService->update($request);
        return to_route('products.index');
    }

    public function destroy($id)
    {
        $this->productService->delete($id);
        return redirect()->route('products.index');
    }

    public function toggleSwitch(Request $request)
    {
        $product = $this->model->find($request->id);
        $product->is_active = $request->is_active ? 1 : 0;
        $isActive = $request->is_active;
        $product->update([
            'is_active' => $isActive
        ]);

        if ($product->is_active == 1) {
            $wishlists = WishList::where('product_id', $product->id)->get();
            foreach ($wishlists as $wishList) {
                $wishList->is_notified = 1;
                $wishList->save();
            }
        }
        return back();
    }

    public function detail($id)
    {
        $product = $this->model->find($id);
        foreach ($product->images as $image) {
            $image->image = asset('storage/images/' . $image->image);
        }
        return inertia('Admin/Product/Detail', ['product' => $product]);
    }
}
