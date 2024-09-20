<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        $categories = $this->categoryService->get();
        if($categories){
            foreach($categories as $category){
                $category->image = $category->image ? asset('storage/images/'. $category->image) : null;
            }
        }
        return Inertia::render('Admin/Category/Index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $this->categoryService->create($request);
        return to_route('categories.index');
    }

    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        $category->image = asset('storage/images/' . $category->image);
        return Inertia::render('Admin/Category/Edit', ['category' => $category]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $this->categoryService->update($request);
        Session::flash('success', 'Update Category Success');
        return to_route('categories.index');
    }

    public function destroy(Request $request)
    {
        $this->categoryService->delete($request->id);
        return back();
    }
}