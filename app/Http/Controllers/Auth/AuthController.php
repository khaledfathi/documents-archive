<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\Log\UserLogRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * User Logs Service Provider [User Logs repository]
     */
    private UserLogRepositoryContract $userLogProvider; 
    public function __construct(
        UserLogRepositoryContract $userLogProvider
    ){
        $this->userLogProvider = $userLogProvider; 
    }
    /**
     * login page 
     * @return mixed view Login page
     */
    public function login(){
        return view('auth.login'); 
    }
    /**
     * authenticate login
     * @param Request $request request credential 
     * @return mixed back to previous page
     */
    public function auth(Request $request){        
        if ( Auth::attempt(['name'=>$request->login , 'password'=>$request->password] , ($request->remember)?true:false) || 
            Auth::attempt(['email'=>$request->login , 'password'=>$request->password] , ($request->remember)?true:false)){
                //save user logedin log 
                $this->userLogProvider->store([
                    'time' => Carbon::now()->toDate(),
                    'ip_address'=>$request->ip(),
                    'user_agent'=>$request->userAgent(),
                    'user_id'=>auth()->user()->id,
                    'auth_status'=>true 
                ]); 
                return redirect(route('dashboard')); 
            }
        return back(); 
    }
    /**
     * Logout 
     * @return mixed redirect to login page - route('login')
     */
    public function logout(){
        Auth::logout(); 
        return redirect(route('login')); 
    }
}
