<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //

    public function __construct(protected Order $order){

    }
    public function index(){
        $orders = $this->order->select('created_at')->get();
        return Inertia::render('Admin/Dashboard',['orders' => $orders]);
    }
}
