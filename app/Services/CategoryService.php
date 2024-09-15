<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\File;

class CategoryService
{

    public function __construct(protected Category $model) {}

    public function get()
    {
        return $this->model->all();
    }

    public function create($request)
    {

        $category = $this->model->create([
            'name' => $request->name,
        ]);
        if ($request->file('image')) {
            $catgoryImage = $request->file('image');
            $categoryImageName = uniqid() . '_' . time() . '.' . $catgoryImage->getClientOriginalExtension();
            $catgoryImage->storeAs('public/images', $categoryImageName);
            $category->image = $categoryImageName;
            $category->save();
        }
        return $category;
    }

    public function update($request)
    {
        $category = $this->model->find($request->id);

        if (!$category) {
            return sendError(404, "Category not found");
        }

        if ($request->hasFile('image')) {
            if ($category->image) {
                File::delete('storage/images/' . $category->image);
            }
            $catgoryImage = $request->file('image');
            $categoryImageName = uniqid() . '_' . time() . '.' . $catgoryImage->getClientOriginalExtension();
            $catgoryImage->storeAs('public/images', $categoryImageName);
            $category->image = $categoryImageName;
        }

        $category->name = $request->name;
        $category->save();
        return $category;
    }

    public function delete($id)
    {
        $category = $this->model->find($id);
        if (!$category) {
            return sendError(404, "Category not found");
        }
        File::delete('storage/images/' . $category->image);
        $category->delete();
    }
}
