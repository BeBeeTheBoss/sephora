<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{
    public function __construct(protected Feedback $feedback){

    }

    public function feedBackPage(){
        return Inertia::render('User/Feedback');
    }

    public function feedback(Request $request){
        $request->validate([
            'message' => 'required'
        ]);

        Feedback::create([
            'user_id' => Auth::user()->id,
            'message' => $request->message
        ]);

        return back();
    }
}
