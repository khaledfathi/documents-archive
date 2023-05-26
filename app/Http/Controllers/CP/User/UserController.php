<?php

namespace App\Http\Controllers\CP\User;

use App\Enum\User\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * User Service Provider [User repository]
     */
    private UserRepositoryContract $userProvider ; 
    public function __construct(
        UserRepositoryContract $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    //private
    /**
     * handle user's image upload 
     * @param mixed $imageFile image file - get it from request 
     * @param int $recordId record id , used to delete old image for this record 
     * @return string the image file name 
     */
    private function uploadImage($imageFile , int $recordId=null):string 
    {
        if ($recordId){
            //delete old image 
            $oldImageFileName = $this->userProvider->show($recordId)->image; 
            Storage::disk('public')->delete('upload/'.$oldImageFileName); 
        }
        //store new image
        $fileName= random_int(0,999).'_'.time().'.'.$imageFile->getClientOriginalExtension(); 
        $imageFile->storeAs('upload', $fileName ,'public');
        //return the new file name 
        return $fileName;
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
        //save image if exists and append file name to data to be saved in database 
        if ($request->image){
            $data['image']=$this->uploadImage($request->file('image')); 
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
        //current pagination value
        $lastPaginationLink = session()->previousUrl(); 

        $userTypes= UserType::cases(); 
        $record = $this->userProvider->show($request->id); 
        return view('cp.user.editUser', [
            'userTypes'=>$userTypes , 
            'user'=>$record,
            'lastPaginationLink'=> $lastPaginationLink 
            ]); 
    }
    /**
     * update user by id 
     * @param Request $request request - to get user id that will be update
     * @return mixed back to previous page 
     */
    public function updateUser(UpdateUserRequest $request){
        $data=[
            'name'=>$request->name,
            'email'=>$request->email,
            'type'=> $request->type
        ];
        //image
        if ($request->has('image')){
            //delete old image and upload new one 
            $data['image'] = $this->uploadImage($request->file('image') , $request->id);  
        }
        if (!empty($request->password)){//if there's a password
            $data['password']=Hash::make($request->password); 
        }
        //update record 
        $this->userProvider->update($data , $request->id); 

        //lastPaginationLink is a double back 
        //because of this edit was redirected from the specific user page in pagination
        return redirect($request->lastPaginationLink); 
    }
}