<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class WishlistController extends Controller
{
    public function wishlist(Request $_request){
Cart::instance('wishlist')-add($_request->id,$_request->title,$_request->price)->assosiate('App\Models\Arts');
return response()->json(['status'=>200,'message'=>'successfull adding wishlist']);
    }
}
