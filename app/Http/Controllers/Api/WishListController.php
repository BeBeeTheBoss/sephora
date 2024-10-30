<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\WishList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WishListController extends Controller
{
    public function notiOff(Request $request){


        $wishLists = WishList::where('product_id',$request->product_id)->orWhere('user_id', $request->user_id)->get();
        foreach($wishLists as $wishList){
            $wishList->update([
                'is_notified' => 0
            ]);
        }

        return response()->json('Change Status Successfully');

    }
}
