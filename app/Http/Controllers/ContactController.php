<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ContactController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) {
            session(['failed' => 'Please login first']);
            return redirect()->back()->with('failed', 'Please login first');
        }

        return Inertia::render('User/Contact');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required'
        ]);

        if (!preg_match('/^\+?[0-9]{10,15}$/', $request->phone)) {
            session(['failed' => "Invalid phone number format"]);
            return back()->withErrors(['phone' => 'Invalid phone number format.']);
        }

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);
        return back();
    }
}
