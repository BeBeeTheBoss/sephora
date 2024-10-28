<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    //
    public function index()
    {
        $contacts = Contact::all();
        return Inertia::render('Admin/Contact/Index', ['contacts' => $contacts]);
    }
}
