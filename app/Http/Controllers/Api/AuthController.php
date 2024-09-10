<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function getUsers()
    {
        return $this->userService->get();
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'password' => 'required'
        ]);

        DB::beginTransaction();
        try {

            $data = $this->userService->register($request);

            DB::commit();

            return sendResponse($data, 201, "Sign up completed!");
        } catch (\Throwable $th) {

            DB::rollBack();
            return sendResponse(null, 500, $th->getMessage());
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $data = $this->userService->login($request);
        if (isset($data['message'])) {
            return sendResponse(null, $data['status'], $data['message']);
        }

        return sendResponse($data, 200, "Login success!");
    }
}
