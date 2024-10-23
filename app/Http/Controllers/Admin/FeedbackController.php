<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{
    public function __construct(protected Feedback $feedback) {}

    public function feedback()
    {
        $feedbacks = Feedback::with('user')->get();
        return Inertia::render('Admin/Feedback', ['feedbacks' => $feedbacks]);
    }
}
