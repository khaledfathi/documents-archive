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
        $users = $this->userProvider->index(15); 
        return view('cp.user.users' ,['users'=>$users]); 
    }
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
    public function createUser(){
        $userTypes= UserType::cases(); 
        return view('cp.user.createUser' , ['userTypes'=>$userTypes]);
    }
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
    public function editUser(Request $request){
        $userTypes= UserType::cases(); 
        $record = $this->userProvider->show($request->id); 
        return view('cp.user.editUser', ['userTypes'=>$userTypes , 'user'=>$record]); 
    }
    public function updateUser(Request $request){
        //update
        return redirect(route('users')); 
    }
}