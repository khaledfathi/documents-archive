<?php

namespace App\Http\Controllers\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * About page
     * @return mixed view about page 
     */
    public function about (){
        return view ('about.index'); 
    }
}
