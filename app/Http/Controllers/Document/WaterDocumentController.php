<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaterDocumentController extends Controller
{
    /**
     * index 
     */
    public function index(){
        return view('document.water.index'); 
    }
}
