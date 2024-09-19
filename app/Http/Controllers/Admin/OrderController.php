<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //
    public function __construct(protected Order $model) {}

    public function index()
    {
        $orders = $this->model->get();
        return Inertia::render('Admin/Order/Index',['orders' => $orders]);
    }
}
