<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function getUsers()
    {
        return $this->userService->get();
    }

    public function loginPage(){
        return Inertia::render('User/Login');
    }

    public function signUpPage(){
        return Inertia::render('User/Signup');
    }

    public function signUp(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        DB::beginTransaction();
        try {

            $this->userService->register($request);

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
        return redirect()->route('home');
    }

    public function logout(){
        Auth::logout();
        session(['success' => 'Logout success']);
        return redirect()->route('home');
    }
}
