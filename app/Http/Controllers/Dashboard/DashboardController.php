<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repository\Contracts\UserRepositoryContracts;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * User Service Provider [user repository]
     */
    private UserRepositoryContracts $userProvider ; 
    public function __construct(
        UserRepositoryContracts $userProvider
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
