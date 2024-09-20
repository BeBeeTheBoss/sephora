<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function __construct(protected WishList $model) {}

    public function index()
    {
        return Inertia::render('User/WishList');
    }
}
