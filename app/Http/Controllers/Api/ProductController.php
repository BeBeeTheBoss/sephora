<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {

    }

    public function index(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
        ]);

        $products = $this->productService->get($request);
        if(isset($products['message'])){
            return sendResponse(null,$products['status'],$products['message']);
        }

        return sendResponse($products,200);

    }

    public function store(ProductRequest $request){

        $product = $this->productService->create($request);
        if(isset($product['message'])){
            return sendResponse(null,$product['status'],$product['message']);
        };

        return sendResponse($product,201,"Product created successfully");
    }

    public function update(ProductRequest $request){
        $request->validate([
            'id' => 'required'
        ]);

        $product = $this->productService->update($request);
        if(isset($product['message'])){
            return sendResponse(null,$product['status'],$product['message']);
        };

        return sendResponse($product,200,"Product updated successfully");
    }

    public function destroy(Request $request){
        $request->validate([
            'id' => 'required'
        ]);

        $product = $this->productService->delete($request->id);
        if(isset($product['message'])){
            return sendResponse(null,$product['status'],$product['message']);
        };

        return sendResponse(null,204,"Product deleted successfully");
    }

}
