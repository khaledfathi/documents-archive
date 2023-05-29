<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricityDocumentController extends Controller
{
    /**
     * index page of electricity documents
     * @return mixed view electricity documents page
     */
    public function index(){
        return view('document.electricity.index'); 
    }
    /**
     * create new electricity bill page 
     * @return mixed view create page for new electriciry bill 
     */
    public function create(){
        return view('document.electricity.create'); 
    }
}
