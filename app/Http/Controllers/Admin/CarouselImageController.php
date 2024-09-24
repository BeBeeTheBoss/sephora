<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselImageController extends Controller
{
    public function __construct(protected CarouselImage $model) {}

    public function index()
    {
        $carouselImages = $this->model->get();
        foreach ($carouselImages as $carouselImage) {
            $carouselImage->name = $carouselImage->name ? asset('storage/images/' . $carouselImage->name) : null;
        }

        return inertia('Admin/Carousel-Images/Index', ['carousel_images' => $carouselImages]);
    }

    public function create()
    {
        return inertia('Admin/Carousel-Images/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpg,jpeg,png,webp'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $this->storeImageFiles($image);
        }

        return to_route('carousel_images.index');
    }

    public function update(Request $request) {}


    public function destroy(Request $request)
    {
        dd($request->all());
    }
    // private function handleImages($request)
    // {
    //     // Delete images marked for removal
    //     if ($request->has('delete_images')) {
    //         foreach ($request->delete_images as $id) {
    //             $image = $product->images()->find($id);
    //             if ($image) {
    //                 // Check if the path exists before attempting to delete
    //                 if ($image->path) {
    //                     Storage::delete($image->path); // Delete the file from storage
    //                 }
    //                 $image->delete(); // Remove the record from the database
    //             }
    //         }
    //     }

    //     // Handle new images
    //     if ($request->hasFile('new_images')) {
    //         $this->storeImageFiles($request->file('new_images'));
    //     }
    // }

    private function storeImageFiles($imageFile)
    {

        $imageName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
        $imageFile->storeAs('public/images', $imageName);
        $this->model->create([
            'name' => $imageName
        ]);
    }
}
