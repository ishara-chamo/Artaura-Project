<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arts;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Category;


class AdminController extends Controller
{
   public function arts(){
      $category=category::all();

    return view('admin.arts',compact('category'));
   }

   public function uploadarts(Request $request){

    $data=new arts;
   $image=$request->file;
   $imagename=time().'.'.$image->getClientOriginalExtension();
   $request->file->move('artimage',$imagename);
   $data->image= $imagename;

   $data->title=$request->title;
   $data->price=$request->price;
   $data->artist=$request->artist;
   $data->description=$request->des;
   $data->quantity=$request->quantity;
   $data->category=$request->category;
   $data->discount=$request->discount;


   $data->save();
   return redirect()->back()->with('message','The art is added successfully!');
   }

   public function showarts(){
      $data=arts::all();
      return view('admin.showarts',compact('data'));
     }
   public function deletearts($id){
$data=arts::find($id);
$data->delete();
return redirect()->back()->with('message','The art is deleted');;
   }
   public function updateview($id){
      $data=arts::find($id);
      
     return view('admin.updateview',compact('data'));
         }

               public function updatearts(Request $request,$id)
               {

                  $data=arts::find($id);
               $image=$request->file;
               if($image){
               $imagename=time().'.'.$image->getClientOriginalExtension();
               $request->file->move('artimage',$imagename);
               $data->image= $imagename;
               }
            
               $data->title=$request->title;
               $data->price=$request->price;
               $data->artist=$request->artist;
               $data->description=$request->des;
               $data->quantity=$request->quantity;
            
               $data->save();
               return redirect()->back()->with('message','The art is updated successfully!');
        
               
}
//view Category
public function view_category(){
   $data=category::all();
   return view('admin.category',compact('data'));
}

//add Category
public function add_category(Request $request){

   $data=new category;
   $data->category_name=$request->category;
   $data->save();
   return redirect()->back()->with('message','The Category Added successfully!');
}

//delete category
public function delete_category($id){
$data=category::find($id);
if($data) { // Check if the record exists
   $data->delete();
   return redirect()->back()->with('message', 'The Category is deleted successfully!');
} else {
   return redirect()->back()->with('error', 'Category not found!');
}

}
//show order
public function showorder(){

   $order=order::all();
   return view('admin.showorder',compact('order'));
}

//show payment
public function showpayment(){

   $order=order::all();
   return view('admin.showpayment',compact('order'));
}

//updatestatus
public function updatestatus($id){
   $order=order::find($id);
   $order->status='delivered';
   $order->save();
   return redirect()->back();
}

}