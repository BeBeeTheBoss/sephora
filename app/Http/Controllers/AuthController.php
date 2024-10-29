<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function getUsers()
    {
        return $this->userService->get();
    }

    public function loginPage()
    {
        return Inertia::render('User/Login');
    }

    public function signUpPage()
    {
        return Inertia::render('User/Signup');
    }

    public function signUp(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required'
        ]);

        $email = User::where('email', $request->email)->pluck('email')->first();
        if ($email) {
            session(['failed' => "This email is already registered"]);
            return redirect()->back();
        }

        DB::beginTransaction();
        try {

            $data = $this->userService->register($request);
            DB::commit();
            return redirect()->route('home');
        } catch (\Throwable $th) {

            DB::rollBack();
            session(['failed' => "Something went wrong"]);
            return redirect()->back();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = $this->userService->login($request);
        if (isset($data['message'])) {
            session(['failed' => $data['message']]);
            return redirect()->back();
        }

        session(['success' => 'Login success']);
        if ($data['user']['role'] === 'admin') {
            session(['success' => 'Login success']);
            return redirect()->route('dashboard');
        }
        return redirect()->route('home');
    }

    public function logout()
    {

        Auth::logout();
        session(['success' => 'Logout success']);
        return redirect()->route('home');


    }

    public function adminLogout()
    {

        Auth::logout();
        session(['success' => 'Logout success']);
        return redirect()->route('loginPage');

    }
}
