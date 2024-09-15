<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    //
    public function __construct(protected Order $model) {}

    public function index()
    {
        return Inertia::render('Admin/Order/Index');
    }
}
