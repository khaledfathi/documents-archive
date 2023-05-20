<?php

namespace App\Http\Controllers\User;

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
    public function indexUser(){
        $users = $this->userProvider->index(); 
        return view('cp.user.users' ,['users'=>$users]); 
    }
    public function storeUser(StoreUserRequest $request)
    {
        $data = $request->only(['name','email']); 
        $data['password']= Hash::make($request->password); 
        $this->userProvider->store($data); 
        return "Store User Method"; 
    }
    public function createUser(){
        return "Create New User Page"; 
    }
}
