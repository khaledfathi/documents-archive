<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\UserRepositoryContracts;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $userProvider ; 
    public function __construct(
        UserRepositoryContracts $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    public function dashboard(){
        $userImage=(auth()->user()->image); 
        ($userImage) ? null : $userImage= "assets/image/svg/default_user_logo.svg";
        return view('layout.main', ['userImage'=>$userImage]);
    }
}
