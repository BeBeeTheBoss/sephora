<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

        $this->handleImages($request, $product);


        return $product;
    }

    public function delete($id)
    {

        $product = $this->model->find($id);
        $productImages = $this->productImage->where('product_id', $id)->get();
        if ($productImages) {
            foreach ($productImages as $productImage) {
                File::delete('storage/images/' . $productImage->image);
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
            'price' => $request->price - ($request->price * $request->discount_price) / 100,
            'discount_price' => $request->price,
            'description' => $request->description ?? null,
            'is_active' => $request->is_active ?? true,
        ];
    }

    private function handleImages($request, $product)
    {
        // Delete images marked for removal
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $id) {
                $image = $product->images()->find($id);
                if ($image) {
                    // Check if the path exists before attempting to delete
                    if ($image->path) {
                        Storage::delete($image->path); // Delete the file from storage
                    }
                    $image->delete(); // Remove the record from the database
                }
            }
        }

        // Handle new images
        if ($request->hasFile('new_images')) {
            $this->storeImageFiles($request->file('new_images'), $product->id);
        }
    }

    private function storeImageFiles($imageFiles, $productId)
    {
        foreach ($imageFiles as $file) {
            $imageName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $imageName);
            $this->productImage->create([
                'product_id' => $productId,
                'image' => $imageName
            ]);
        }
    }
}
