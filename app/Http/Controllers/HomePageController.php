<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function homePage()
    {
        return Inertia::render('User/Home');
    }
}