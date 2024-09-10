<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;

class ProductService
{

    public function __construct(protected Product $model, protected Category $category) {}

    public function get($request)
    {
        $category = $this->category->find($request->category_id);
        if (!$category) {
            return sendError(404, "Category not found");
        }

        return $category->products;
    }

    public function create($request)
    {
        $category = $this->category->find($request->category_id);
        if (!$category) {
            return sendError(404, "Category not found");
        }

        $product = $this->model->create($this->formatData($request));

        return $product;
    }

    public function update($request)
    {

        $product = $this->model->find($request->id);
        if (!$product) {
            return sendError(404, "Product not found");
        }

        $category = $this->category->find($request->category_id);
        if (!$category) {
            return sendError(404, "Category not found");
        }

        $product->update($this->formatData($request));

        return $product;
    }

    public function delete($id)
    {

        $product = $this->model->find($id);
        if (!$product) {
            return sendError(404, "Product not found");
        }
        $product->delete();
    }

    private function formatData($request)
    {
        return [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'discount_price' => $request->discount_price ?? null,
            'description' => $request->description ?? null,
            'is_active' => $request->is_active ?? true,
        ];
    }
}
