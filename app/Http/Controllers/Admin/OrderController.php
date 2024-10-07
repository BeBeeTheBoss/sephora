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
        $orders = $this->model
            ->with('user')
            ->with('payment')
            ->with(['order_products' => function ($query) {
                $query->with('product');
            }])
            ->get();


        foreach ($orders as $order) {
            $order['total_price'] = $order->order_products->sum('total_price');
            $order['ss_image'] = asset('storage/images/' . $order->ss_image);
        }
        return Inertia::render('Admin/Order/Index', ['orders' => $orders]);
    }

    public function decision(Request $request)
    {
        $order = $this->model->find($request->id);
        if ($request->status === 'accept') {
            $order->status = 'delivered';
        } else {
            $order->status = 'rejected';
        }
        $order->save();
        return back();
    }
}
