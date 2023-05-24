<?php

namespace App\Http\Controllers\CP\User;

use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Repository\Contracts\UserRepositoryContracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * User Service Provider [User repository]
     */
    public $userProvider ; 
    public function __construct(
        UserRepositoryContracts $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    //private
    /**
     * handle user's image upload 
     * @param mixed $image
     * @return string the image file name 
     */
    private function uploadImage($image):string 
    {
        //return path of uploaded image file
        
        return "Image File Name"; 
    }
    //public 
    /**
     * users page - get all users 
     * @return mixed view users page
     */
    public function indexUser(){
        $users = $this->userProvider->index(15); 
        return view('cp.user.users' ,['users'=>$users]); 
    }
    /**
     * store new user 
     * @param StoreUserRequest $request custom request for storing new user
     * @return mixed redirect to users page - route('users') 
     */
    public function storeUser(StoreUserRequest $request)
    {
        //prepare data
        $data = $request->only(['name','email']);

        //save image if exists
        if ($request->image){
            $imageFile = $request->file('image');
            $fileName= random_int(0,999).'_'.time().'.'.$imageFile->getClientOriginalExtension(); 
            $imageFile->storeAs('upload', $fileName ,'public');
            $data['image']= $fileName;
        }
        $data['password']= Hash::make($request->password); 
        $this->userProvider->store($data); 
        return redirect(route('users')); 
    }
    /**
     * create new user page
     * @return mixed view create user page 
     */
    public function createUser(){
        $userTypes= UserType::cases(); 
        return view('cp.user.createUser' , ['userTypes'=>$userTypes]);
    }
    /**
     * destroy user by id 
     * @param Request $request request - to get user id 
     * @return mixed back to previous page
     */
    public function destroyUser(Request $request){
        if (auth()->user()->id == $request->id){
            return back()->withErrors('you can\'t delete your account !'); 
        }
        $record = $this->userProvider->show($request->id);
        if ($record){
            //remove user image
            Storage::disk('public')->delete('upload/'.$record->image); 
        }
        $this->userProvider->destroy($request->id);
        // return redirect(route('users')); 
        return back(); 
    }
    /**
     * view edit user page with display user's data that selected by is 
     * @param Request $request request - to get user id that will be edited 
     * @return mixed view edit page
     */
    public function editUser(Request $request){
        $userTypes= UserType::cases(); 
        $record = $this->userProvider->show($request->id); 
        return view('cp.user.editUser', ['userTypes'=>$userTypes , 'user'=>$record]); 
    }
    /**
     * update user by id 
     * @param Request $request request - to get user id that will be update
     * @return mixed redirect to users page - route('users')
     */
    public function updateUser(Request $request){
        //update
        return redirect(route('users')); 
    }
}