<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService)
    {

    }

    public function index()
    {

        $categories = $this->categoryService->get();

        return sendResponse($categories,200);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        $category = $this->categoryService->create($request);

        return sendResponse($category,201,"Category created successfully");
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $category = $this->categoryService->update($request);
        if(isset($category['message'])){
            return sendResponse(null,$category['status'],$category['message']);
        }

        return sendResponse($category,201,"Category updated successfully");
    }

    public function destroy(Request $request){
        $request->validate([
            'id' => 'required',
        ]);

        $category = $this->categoryService->delete($request->id);
        if(isset($category['message'])){
            return sendResponse(null,$category['status'],$category['message']);
        }

        return sendResponse(null,204,"Category deleted successfully");
    }

}
