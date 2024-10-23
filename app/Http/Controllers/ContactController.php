<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    //
    public function index()
    {
        return Inertia::render('User/Contact');
    }

    public function create(){
        return back();
    }
}
