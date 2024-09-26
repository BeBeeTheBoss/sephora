<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //

    public function __construct(protected Order $order){

    }
    public function index(){
        $orders = $this->order->select('created_at')->get();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $orderCount = $this->order->count();
        $customerCount = User::where('role', 'user')->count();
        $dashboardCards = [
                [
                    "id" => 1,
                    "title" => "Total Categories",
                    "count" => $categoryCount,
                    "icon" => ""
                ],
                [
                    "id" => 2,
                    "title" => "Total Products",
                    "count" => $productCount,
                    "icon" => ""
                ],
                [
                    "id" => 3,
                    "title" => "Total Orders",
                    "count" => $orderCount,
                    "icon" => ""
                ],
                [
                    "id" => 4,
                    "title" => "Total Customers",
                    "count" => $customerCount,
                    "icon" => ""
                ]
                ];
        return Inertia::render('Admin/Dashboard',['orders' => $orders, 'dashboardCards' => $dashboardCards]);
    }
}
