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
        $users = User::get();
        return Inertia::render('Admin/User/Index', ['users' => $users]);
    }

    public function changeRole(Request $request){
        $user = $this->user->find($request->id);
        if($user->role == 'admin'){
            $user->role = 'user';
        }else{
            $user->role = 'admin';
        }
        $user->save();
        return back();
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
