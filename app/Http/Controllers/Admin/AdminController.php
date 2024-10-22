<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use Laravel\Sanctum\PersonalAccessToken;

class AdminController extends Controller
{
    //

    public function __construct(protected Order $order) {}
    public function index()
    {
        $orders = $this->order->select('created_at')->get();
        $categoryCount = Category::count();
        $productCount = Product::count();
        $orderCount = $this->order->count();
        $orderProducts = OrderProduct::select('total_price', 'created_at')->get();
        $customerCount = User::where('role', 'user')->count();
        $tokens = PersonalAccessToken::select('personal_access_tokens.tokenable_id','personal_access_tokens.created_at')
        ->join('users', 'personal_access_tokens.tokenable_id','=', 'users.id')
        ->where('users.role', '!=', 'admin')
        ->get();
        $dashboardCards = [
            [
                "id" => 1,
                "title" => "Total Categories",
                "count" => $categoryCount,
                "icon" => "fa-solid fa-list"
            ],
            [
                "id" => 2,
                "title" => "Total Products",
                "count" => $productCount,
                "icon" => "fa-solid fa-box"
            ],
            [
                "id" => 3,
                "title" => "Total Orders",
                "count" => $orderCount,
                "icon" => "fa-solid fa-cart-shopping"
            ],
            [
                "id" => 4,
                "title" => "Total Customers",
                "count" => $customerCount,
                "icon" => "fa-regular fa-user"
            ]
        ];
        return Inertia::render('Admin/Dashboard', ['orders' => $orders, 'dashboardCards' => $dashboardCards, 'orderProducts' => $orderProducts, 'tokens' => $tokens]);
    }
}
