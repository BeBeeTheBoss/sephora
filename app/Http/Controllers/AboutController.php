<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    //
    public function index()
    {
        $feedbacks = Feedback::with('user')->get();
        $categories = Category::all();
        return Inertia::render('User/About', ['feedbacks' => $feedbacks, 'categories' => $categories]);
    }
}
