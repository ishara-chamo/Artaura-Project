<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\support\Facades\Auth;
use Illuminate\support\Facades\Hash;
use Illuminate\Support\Facades\Session;



class manageLogin extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('home'));    
        }
        return view('login');
    }
    function registration(){
        if(Auth::check()){
            return redirect(route('home'));    
        }
        return view('registration');
    }

    //validation email and password

    public function loginPost(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        //get error message automatically

        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
           return redirect('redirect');
        }

        //error key and message
        return redirect(route('login'))->with("error", "login unsuccessful");

    }

    //Registration form validation
    function registrationPost(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required']);

             //Access the name,email,password from the request
    $data['name']=$request->name;
    $data['email']=$request->email;
    $data['password']=Hash::make ($request->password);

    //using created model
    $user=User::create($data);

    //error message for registration form
    if(!$user){
        return redirect(route('registration'))->with("error","Registration failed, try again");
    }
    return redirect(route('login'))->with("Successfull","Registration successful. Now you can login");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
   
}
