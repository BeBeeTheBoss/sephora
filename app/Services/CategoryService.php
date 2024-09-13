<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{

    public function __construct(protected Category $model) {}

    public function get()
    {
        return $this->model->all();
    }

    public function create($request)
    {
        return $this->model->create($request);
    }

    public function update($request)
    {
        $category = $this->model->find($request->id);

        if (!$category) {
            return sendError(404, "Category not found");
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
        $category->delete();
    }
}
