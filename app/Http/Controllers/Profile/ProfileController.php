<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateUserEmailRequest;
use App\Http\Requests\Profile\UpdateUserPasswordRequest;
use App\Repository\Contracts\UserRepositoryContracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * User Service Provider [User repository]
     */
    private UserRepositoryContracts $userProvider ; 
    public function __construct(
        UserRepositoryContracts $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    /**
     * Profile page
     * @return mixed view Profile Page
     */
    public function profile(){        
        return view('profile.profile'); 
    }
    /**
     * update current user's Email address 
     * @param UpdateUserEmailRequest $request request - used  to get new email address to replace  old one 
     * @return mixed back to previous page with error|success message
     */
    public function updateEmail(UpdateUserEmailRequest $request){
        //update on database , id has been set from current user loged in 
        $this->userProvider->update(['email'=>$request->email],auth()->user()->id);  
        return back()->with(['ok'=>'Email Address has been updated']); 
    }
    /**
     * update current user's password
     * @param UpdateUserPasswordRequest $request
     * @return mixed back to previous page with error|success message
     */
    public function updatePassword(UpdateUserPasswordRequest $request){
       if ( Hash::check($request->old_password, auth()->user()->password)){
            //update on database , id has been set from current user loged in 
            $this->userProvider->update(['password'=>Hash::make($request->password)], auth()->user()->id); 
            return back()->with(['ok'=>'Password has been updated']); 
       }
       return back()->withErrors('Old password is worng !');
    }
    public function deleteAccount(Request $request){
        //compare password with user password 
        if (Hash::check($request->password,auth()->user()->password)) {
            $this->userProvider->destroy(auth()->user()->id); 
            return redirect(route('logout')); 
        }; 
        return back()->withErrors('Password is wrong !'); 
    }
}
