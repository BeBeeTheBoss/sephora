<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected Order $model) {}

    public function index()
    {
        return Inertia::render('User/Order');
    }
}
