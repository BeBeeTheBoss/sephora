<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    //

    public function __construct(protected User $user) {}

    public function index()
    {
        $users = User::where('role', 'user')->get();
        return Inertia::render('Admin/User/Index', ['users' => $users]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
        }

        return back();
    }
}
