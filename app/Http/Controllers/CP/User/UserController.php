<?php

namespace App\Http\Controllers\CP\User;

use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Repository\Contracts\UserRepositoryContracts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $userProvider ; 
    public function __construct(
        UserRepositoryContracts $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    //private
    private function uploadImage($image){
        //return path of uploaded image file
        
        return ""; 
    }
    //public 
    public function indexUser(){
        $users = $this->userProvider->index(); 
        return view('cp.user.users' ,['users'=>$users]); 
    }
    public function storeUser(StoreUserRequest $request)
    {
        //image
        $imageFile = $request->file('image'); 
        dd($imageFile); 
        //db
        $data = $request->only(['name','email','image']); 
        $data['password']= Hash::make($request->password); 
        $this->userProvider->store($data); 
        return "Store User Method"; 
    }
    public function createUser(){
        $userTypes= UserType::cases(); 
        return view('cp.user.createUser' , ['userTypes'=>$userTypes]);
    }
}