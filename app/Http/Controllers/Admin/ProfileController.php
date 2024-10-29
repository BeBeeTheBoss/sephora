<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct(protected User $user) {}

    public function profile()
    {
        $admin = User::where('role', 'admin')
            ->first();
        return Inertia::render('Admin/Profile', ['admin' => $admin]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'nullable',
            'email' => 'required',
            'password' => 'nullable',
        ]);

        $email = User::where('email', $request->email)
        ->where('id', '!=', $user->id)->pluck('email')->first();
        if ($email) {
            session(['failed' => "This email is already taken"]);
            return back();
        }

        $data = $this->formatData($request, $user);
        $user->update($data);
        session(['success' => 'Update Profile Success']);
        return redirect()->route('dashboard');
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
