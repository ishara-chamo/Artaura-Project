<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
//use App\Models\OrderItems;
class OrderController extends Controller
{
   

   /* public function placeOrder(Request $request)
    {
        Validate the incoming request
        $validatedData = $request->validate([
            'firstname' => 'required',
            'email' => 'required|email',
            'address' => 'required|address',
            'phone' => 'required|phone',
            'city' => 'required|city',
            'state' => 'required|state',
            'zip' => 'required|zip',
            'cardname' => 'required|cardname',
            'cardnumber' => 'required|cardnumber',
            'expmonth' => 'required|expmonth',
            'expyear' => 'required|expyear',
            'cvv' => 'required|cvv'
      
        ]);

        

        // Save the order to the database
        $order = new Order();
        $order->fname = $request->input('firstname');
        $order->lname = $request->input('lastname');
        $order->email = $request->input('email');
        $order->address = $request->input('address');
        $order->phone = $request->input('phone');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->zip = $request->input('zip');
        $order->cardname = $request->input('cardname');
        $order->cardnumber = $request->input('cardnumber');
        $order->expmonth = $request->input('expmonth');
        $order->expyear = $request->input('expyear');
        $order->cvv = $request->input('cvv');
        $order->tracking_no = 'ishara'.rand(1111,9999);
        
        $order->save();

       
       /* $user=auth()->user();
        $cart=cart::where('email',$user->email)->get();
foreach($cart as $items){
    
    orderItem::create([
        'order_id'=> $order->id,
        'arts_id'=> $items->arts_id,
        'quantity'=> $items->qunatity,
        'price'=> $items->price,
    ]);
}


        return redirect('/order')->with('success', 'Order is Successfully');
    }*/
    
}
