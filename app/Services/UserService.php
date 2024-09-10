<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(protected User $model) {}

    public function get()
    {
        return $this->model->get();
    }

    public function register($request)
    {
        $user = $this->model->create($this->formatData($request));

        $user = $this->model->find($user->id);
        Auth::login($user);

        $token = $user->createToken('Sephora_Token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $data;
    }

    public function login($request)
    {
        $user = $this->model->where('phone', $request->phone)->first();
        if (!$user) {
            return sendError(404, "This phone number is not registered yet");
        }

        if (!Hash::check($request->password, $user->password)) {
            return sendError(401, "The password you entered is incorrect");
        }

        Auth::login($user);
        $token = $user->createToken('Sephora_Token')->plainTextToken;

        $data = [
            'user' => $user,
            'token' => $token
        ];

        return $data;
    }

    private function formatData($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ];
    }
}
