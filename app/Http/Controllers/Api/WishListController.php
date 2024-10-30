<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class WishListController extends Controller
{
    public function notiOff(Request $request)
    {
        $wishLists = WishList::where('product_id', $request->product_id)
            ->where('user_id', $request->user_id);

        $wishLists->update(['is_notified' => 0]);

        $updatedWishLists = $wishLists->get();

        return response()->json([
            'message' => 'Change Status Successfully',
            'updated_wishlists' => $updatedWishLists
        ]);
    }
}
