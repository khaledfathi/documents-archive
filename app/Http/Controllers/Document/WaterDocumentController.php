<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WaterDocumentController extends Controller
{
    /**
     * view water bills page 
     * @param Request $request client request
     * @return mixed  view of water bills page [route('document.water.index')]
     */
    public function index(Request $request){
        //set year 
        ($request->has('year'))? $currentYear = $request->year : $currentYear= CURRENT_YEAR;

        return view('document.water.index' ,[
            'currentYear'=>$currentYear
        ]); 
    }
    /**
     * view create new water bill page 
     * @param Request $requset client request
     * @return mixed view of createing new bill page 
     */
    public function create(Request $request){
        return  view ('document.water.create'); 
    }
    /**
     * store water bill in data base 
     * @param Request $request client request - get the data to be store
     * @return mixed redirect to water index page with last year value in request  
     */
    public function store (Request $request){
        return "store water bill method "; 
        
    }

}
