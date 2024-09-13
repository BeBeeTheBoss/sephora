<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    //
    public function __construct(protected CategoryService $categoryService){

    }

    public function index(){
        return Inertia::render('Admin/Components/Category');
        // $categories = $this->categoryService->get();
        // return Inertia::render('Admin/Components/Category',['categories' => $categories]);
    }
}
