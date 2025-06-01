<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Arts;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;

class CheckoutController extends Controller
{
     public function index()
     {
         $user=auth()->user();
         $cart=cart::where('email',$user->email)->get();
 return view('user.checkout',compact('cart'));
        // Validation rules
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'cardname' => 'required',
            'cardnumber' => 'required|numeric',
            'expmonth' => 'required|numeric',
            'cvv' => 'required|numeric',
        ]);
      }

     public function placeorder(Request $request){

      $order =new Order;
      $order->fname=$request->input('firstname');
      $order->lname=$request->input('lastname');
      $order->address=$request->input('address');
      $order->phone=$request->input('phone');
      $order->email=$request->input('email');
      $order->city=$request->input('city');
      $order->state=$request->input('state');
      $order->zip=$request->input('zip');
      $order->cardname=$request->input('cardname');
      $order->cardnumber=$request->input('cardnumber');
      $order->expmonth=$request->input('expmonth');
      $order->cvv=$request->input('cvv');
      $order->tracking_no = 'ishara' . rand(1111, 9999);

      $order->status="not delivered";

      $order->save();

// Get the user's cart items
$user = auth()->user();
$cart = Cart::where('email', $user->email)->get();

// Create order items and decrement product quantity
foreach ($cart as $carts) {
    // Create order item
    $orderItem = new Orderitem;
    $orderItem->order_id = $order->id;
    $orderItem->arts_title = $carts->arts_title;
    $orderItem->price = $carts->price;
    $orderItem->quantity = $carts->quantity;
    // Add other order item details...
    $orderItem->save();

    // Decrement product quantity (Assuming 'arts' table has 'quantity' column)
    $art = Arts::where('title', $carts->arts_title)->first();
    if ($art) {
        $art->quantity -= 1; // Decrement by 1
        $art->save();
    }

  
}



      return view('user.myorder');

     }
    }
   
  

