<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function __construct(protected CategoryService $categoryService) {}

    public function index()
    {
        $categories = $this->categoryService->get();
        return Inertia::render('Admin/Category/Index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Admin/Category/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $this->categoryService->create($request->name);
        return Inertia::render('Admin/Category/Index');
    }

    public function edit(Request $request)
    {
        $category = Category::find($request->id);
        return Inertia::render('Admin/Category/Edit', ['category' => $category]);
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required'
        ]);
        $this->categoryService->update($request);
        return redirect('/admin/categories');
    }
}
