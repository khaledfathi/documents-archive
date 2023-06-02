<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\User\UserRepositoryContract;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * User Service Provider [user repository]
     */
    private UserRepositoryContract $userProvider ; 
    public function __construct(
        UserRepositoryContract $userProvider
    )
    {
        $this->userProvider = $userProvider; 
    }
    /**
     * Dashboard page
     * @return mixed view dashboard page
     */
    public function dashboard(){
        return view('dashboard.all');
    }
}
