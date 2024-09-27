<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct(protected Order $model) {}

    public function index()
    {
        $orders = $this->model->where('user_id', Auth::user()->id)->with('payment')->with(['order_products' => function ($query) {
            $query->with('product');
        }])->get();

        foreach ($orders as $order) {
            $order['total_price'] = $order->order_products->sum('total_price');
            $order['ss_image'] = asset('storage/images/' . $order['ss_image']);
        }

        return Inertia::render('User/Order', [
            'orders' => $orders
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ss_image' => 'mimes:png,jpg,jpeg,webp,svg'
        ]);

        $data = $this->formatData($request);

        $imageFile = $request->file('ss_image');
        $imageName = uniqid() . '_' . time() . '.' . $imageFile->getClientOriginalExtension();
        // $imageFile->storeAs('public/images', $imageName);
        $data['ss_image'] = $imageName;

        $last_order = $this->model->latest()->select('order_code')->first();
        if (!$last_order) {
            $order_code = "SEP_ORD#1";
        } else {
            $order_code = $this->generateOrderCode($last_order->order_code);
        }

        $data['order_code'] = $order_code;
        $order = $this->model->create($data);

        foreach ($request->order_products as $order_product) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $order_product['product_id'],
                'price' => $order_product['price'],
                'quantity' => $order_product['quantity'],
                'total_price' => $order_product['total_price']
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        session(['success' => 'Order placed successfully']);
        return back();
    }

    public function refund(Request $request)
    {
        $order = $this->model->find($request->id);

        if ($order->status != 'pending') {
            session(['failed' => 'Only pending order can be refunded']);
            return back();
        }

        OrderProduct::where('order_id', $request->id)->delete();
        $order->delete();
        session(['success' => 'Order refunded successfully']);
        return back();
    }

    public function received(Request $request)
    {
        $order = $this->model->find($request->id);
        $order->status = 'completed';
        $order->save();
        session(['success' => 'You received the order successfully']);
        return back();
    }

    private function generateOrderCode($order_code)
    {
        $order_code = explode('#', $order_code)[1];
        $number = ((int) $order_code) + 1;
        return "SEP_ORD#" . $number;
    }

    private function formatData($request)
    {
        return [
            'user_id' => Auth::user()->id,
            'payment_id' => $request->payment_id,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}
