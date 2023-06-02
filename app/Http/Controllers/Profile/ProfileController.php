<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateUserEmailRequest;
use App\Http\Requests\Profile\UpdateUserPasswordRequest;
use App\Repository\Contracts\Log\UserLogRepositoryContract;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * User Service Provider [User repository]
     */
    private UserRepositoryContract $userProvider ; 
    /**
     * User Log Service Provider [User Log Reposiroty]
     */
    private UserLogRepositoryContract $userLogProvider ; 
    public function __construct(
        UserRepositoryContract $userProvider,
        UserLogRepositoryContract $userLogProvider
    )
    {
        $this->userProvider = $userProvider; 
        $this->userLogProvider = $userLogProvider; 
    }
    /**
     * Profile page
     * @return mixed view Profile Page
     */
    public function profile(Request $request){
        $userLogs = $this->userLogProvider->index(4); 
        return view('profile.profile' , ['userLogs'=>$userLogs]); 
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
    /**
     * destroy all user's logs from 'user_logs table in database '
     * @return mixed back to previous page
     */
    public function clearUserLogs(){
        $this->userLogProvider->destroyAllRelatedToUser(auth()->user()->id); 
        return back()->with(['ok'=>'Logs has been cleared']); 
    }
    /**
     * destroy specific user's log from 'user_logs'  table in database 
     * @param Request $request requset- used to get the log id to be destroy
     * @return mixed back to previous page 
     */
    public function destroyUserLog(Request $request){
       $this->userLogProvider->destroyOneRelatedToUser($request->id , auth()->user()->id); 
       return back()->with(['ok'=>'Log has been deleted']); 
    }
}
