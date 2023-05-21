<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login'); 
    }
    public function auth(Request $request){
        
        if ( Auth::attempt(['name'=>$request->login , 'password'=>$request->password] , ($request->remember)?true:false) || 
            Auth::attempt(['email'=>$request->login , 'password'=>$request->password] , ($request->remember)?true:false)){
                return redirect(route('dashboard')); 
            }
        return back(); 
    }
    public function logout(){
        Auth::logout(); 
        return redirect(route('login')); 
    }
}
