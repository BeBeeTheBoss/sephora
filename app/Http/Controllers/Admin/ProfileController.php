<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(protected User $user){

    }

    public function profile(){
        $admin = User::where('role', 'admin')
        ->where('id', 1)
        ->first();
        return Inertia::render('Admin/Profile',['admin' => $admin]);
    }
}
