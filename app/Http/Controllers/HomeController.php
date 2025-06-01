<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Arts;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;




class HomeController extends Controller
{
    public function redirect(){
//Login type***
$usertype=Auth::user()->usertype;

if($usertype=='1'){
    return view('admin.home');
}
else{
   $data=arts::paginate(3);
   $user=auth()->user();
   $count=cart::where('email',$user->email)->count();
    return view('user.home',compact('data','count'));
}

    }

    //Home
    public function index(){
if(Auth::id()){
    return redirect('redirect');
}
else
{
  $data=arts::paginate(3);
    return view('user.home',compact('data'));
}
 
//Search bar
    }
    public function search(Request $request){
$search=$request->search;
if($search==''){
    $data=arts::paginate(3);
    return view('user.home',compact('data'));
}
//condition
$data=arts::where('title','Like','%'.$search.'%')->get();
return view('user.home',compact('data'));
    }
    //cart
    public function addcart(Request $request,$id){
    if(Auth::id()){
        $user=auth()->user();
        $arts=arts::find($id);
        $cart=new cart;
        $cart->name=$user->name;
        $cart->email=$user->email;
        $cart->arts_title=$arts->title;
        $cart->price=$arts->price;
        $cart->quantity=$request->quantity;
        $cart->save();

        return redirect()->back()->with('message','The Art is Added successfully!');
    }
    else{
        return redirect('login');
    }
}

//Showcart

public function showcart(){
    $user=auth()->user();
    $cart=cart::where('email',$user->email)->get();
    $count=cart::where('email',$user->email)->count();
    return view ('user.showcart',compact('count','cart'));
}

public function deletecart($id){
    $data=cart::find($id);

    //deleting Art ID
    $data->delete();
    return redirect()->back()->with('message','Your Cart is Removed');
}

//gallary
public function gallary(){
    $data=arts::paginate(3);
        return view('user.gallary',compact('data'));
    
 
}
//offers
public function myoffers(){
    $data=arts::paginate(3);
    $user=auth()->user();
        return view('user.myoffers',compact('data'));


}

//about
public function about(){
    
    return view('user.about');
}

//place-order
public function myorder(){
    
    return view('user.myorder');
}

//art Details
public function art_details($id){
    $arts=arts::find($id);
return view('user.art_details',compact('arts'));
}

// public function discription(){
//     $data=arts::all();
//     $user=auth()->user();
//     return view('user.discription',compact('data'));
// }
/*public function orderitem(Request $request){
    $user=auth()->user();
    $email=user()->email;
    
    foreach($request->artname as $key->artname){

        $orderitem=new Orderitem;
        $orderitem->arts_title=$request->artname[$key];
        $orderitem->price=$request->price[$key];
        $orderitem->quantity=$request->quantity[$key];

        $orderitem->email=$email;

        $orderitem->save();

    }
    return redirect()->back();


}
/*Category
public function category(){

    $category=Category::where('status','0')->get();
    return view('user.category',compact('category'));
}*/

}