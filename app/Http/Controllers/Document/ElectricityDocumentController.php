<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\Electricity\StoreElectrictyRequest;
use App\Repository\Contracts\Document\ElectricityRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ElectricityDocumentController extends Controller
{
    private ElectricityRepositoryContract $electriciryProvider ; 
    public function __construct(
        ElectricityRepositoryContract $electricityProvider 
    )
    {
        $this->electriciryProvider = $electricityProvider;    
    }
    /**
     * index page of electricity documents
     * @return mixed view electricity documents page
     */
    public function index(Request $request){
        //set year
        $currentYear=Carbon::now()->year ; 
        if($request->has('year')){
            $currentYear = $request->year; 
        }

        //view bills
        $bills = $this->electriciryProvider->index(auth()->user()->id , $currentYear); 
        return view('document.electricity.index' , ['bills'=>$bills]); 
    }
    /**
     * create new electricity bill page 
     * @return mixed view create page for new electriciry bill 
     */
    public function create(){
        $time = Carbon::now(); 
        $currentYear = $time->year;
        $currentMonth = $time->month;
        return view('document.electricity.create' , [
            'currentYear'=>$currentYear,
            'currentMonth'=>$currentMonth
        ]); 
    }
    /**
     * store new electricity bill in database
     * @param StoreElectrictyRequest $request client request - data to store
     * @return mixed back to document index page . route('document.electricity.index')
     */
    public function store(StoreElectrictyRequest $request){
        // dd($request->all()); 

        $data = $this->electriciryProvider->store([
            'user_id'=>auth()->user()->id,
            'release_date'=>$request->release_date,
            'consumption'=>$request->consumption,
            'amount'=>$request->amount,
            'month'=>$request->month,
            'year'=>$request->year,
            'image'=>$request->image, 
            'notes'=>$request->notes
        ]);  
        return redirect(route('document.electricity.index')); 
    }
}
