<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricityDocumentController extends Controller
{
    public function indexElectricityDocument(){
        return view('document.electricityDocuments'); 
    }
}
