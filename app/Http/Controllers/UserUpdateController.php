<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Models\User;

class UserUpdateController extends Controller
{
    //
    public function index()
    {
        if (!Auth::check()) {
            session(['failed' => 'Please login first']);
            return back();
        }
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
        session(['success' => 'Update Successfully']);
        return redirect()->route('home');

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
