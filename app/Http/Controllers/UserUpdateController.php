<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserUpdateController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        return Inertia::render('User/UpdateUserProfile', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'nullable',
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $data = $this->formatData($request, $user);
        $user->update($data);
        return back();
    }

    private function formatData($request, $user)
    {
        $data =  [
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        return $data;
    }
}
