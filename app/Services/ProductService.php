<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;

class ProductService
{

    public function __construct(protected Product $model, protected Category $category, protected ProductImage $productImage) {}

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
        if ($request->file('images')) {
            $imageFiles = $request->file('images');
            $this->storeImageFiles($imageFiles, $product->id);
        }

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
        $productImages = $this->productImage->where('product_id', $id)->get();
        if ($productImages) {
            foreach ($productImages as $productImage) {
                File::delete('/storage/images' . $productImage->image);
                $productImage->delete();
            }
        }
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

    private function storeImageFiles($imageFiles, $productId)
    {
        $imageCount = count($imageFiles);
        for ($i = 0; $i < $imageCount; $i++) {
            $imageName = uniqid() . '_' . time() . '.' . $imageFiles[$i]->getClientOriginalExtension();
            $imageFiles[$i]->storeAs('public/images', $imageName);
            $this->productImage->create([
                'product_id' => $productId,
                'image' => $imageName
            ]);
        }
    }
}
