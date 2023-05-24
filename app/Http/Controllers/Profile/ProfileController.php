<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Profile page
     * @return mixed view Profile Page
     */
    public function profile(){
        return view('profile.profile'); 
    }
}
