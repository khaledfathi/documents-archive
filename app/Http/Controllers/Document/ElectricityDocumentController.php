<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use App\Http\Requests\Document\Electricity\StoreElectrictyRequest;
use App\Http\Requests\Document\Electricity\UpdateElectricityRequest;
use App\Repository\Contracts\Document\ElectricityRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Helper\GeneralHelp; 

class ElectricityDocumentController extends Controller
{
    use GeneralHelp; 
    /**
     * Electricity Service Provider [Electricity repository]
     */
    private ElectricityRepositoryContract $electriciryProvider ; 
    public function __construct(
        ElectricityRepositoryContract $electricityProvider 
    )
    {
        $this->electriciryProvider = $electricityProvider;    
    }

    //PRIVATE METHODS
        //

    //PUBLIC METHODS
    /**
     * index page of electricity documents
     * @param Request $name client request 
     * @return mixed view electricity documents page
     */
    public function index(Request $request){
        //set year
        ($request->has('year'))? $currentYear = $request->year : $currentYear= CURRENT_YEAR;         
        //view bills
        $bills = $this->electriciryProvider->index(auth()->user()->id , $currentYear); 
        //statistics for consumption
        $ConsumptionStatistics = (object)[
            'min'=>$this->electriciryProvider->statisticMin('consumption',$currentYear , auth()->user()->id),
            'max'=>$this->electriciryProvider->statisticMax('consumption',$currentYear , auth()->user()->id),
            'avg'=>$this->electriciryProvider->statisticAvg('consumption',$currentYear , auth()->user()->id),
        ]; 
        //statistics for amount
        $amountStatistics = (object)[
            'min'=>$this->electriciryProvider->statisticMin('amount', $currentYear , auth()->user()->id),
            'max'=>$this->electriciryProvider->statisticMax('amount', $currentYear , auth()->user()->id),
            'avg'=>$this->electriciryProvider->statisticAvg('amount', $currentYear , auth()->user()->id),
        ]; 
        
        return view('document.electricity.index' , [
            'bills'=>$bills , 
            'currentYear'=>$currentYear,
            'consumptionStatistics'=>$ConsumptionStatistics,
            'amountStatistics'=>$amountStatistics
        ]); 
    }
    /**
     * create new electricity bill page 
     * @return mixed view create page for new electriciry bill 
     */
    public function create(){
        return view('document.electricity.create'); 
    }
    /**
     * store new electricity bill in database
     * @param StoreElectrictyRequest $request client request - data to store
     * @return mixed back to document index page . route('document.electricity.index')
     */
    public function store(StoreElectrictyRequest $request){
        $image = $this->uploadImage($request->file('image'), 'electricity',  $this->electriciryProvider); 
        $data = $this->electriciryProvider->store([
            'user_id'=>auth()->user()->id,
            'release_date'=>$request->release_date,
            'consumption'=>$request->consumption,
            'amount'=>$request->amount,
            'month'=>$request->month,
            'year'=>$request->year,
            'image'=>$image, 
            'notes'=>$request->notes
        ]);  
        $message = 'The Bill of ( '.MONTHS[$request->month-1].' / '.$request->year.' ) has been Created. '; 
        return redirect(route('document.electricity.index').'?year='.$request->year)->with(['ok'=>$message]); 
    }
    /**
     * destroy electricity bill action
     * @param Request $request client request (to get the electricity bill id )
     * @return mixed back to previous page
     */
    public function destroy(Request $request){
        //find record to get path of image perpearing to delete it
        $record = $this->electriciryProvider->show($request->id); 
        //delete image before delete record 
        if ($record->image && $this->isBelongToUser($request->id , $this->electriciryProvider)) {
            Storage::disk('public')->delete('electricity/'.$record->image); 
            $this->electriciryProvider->destroy($request->id , auth()->user()->id); 
        }
        return back(); 
    }
    /**
     * edit electricity bill page 
     * @param Request $request client request (to get electricit bill to be edit )
     * @return mixed view document.electricity.edit page
     */
    public function edit (Request $request){
        //get record 
        $record = $this->electriciryProvider->show($request->id); 
        //check if this record belong to the current user 
        if ($this->isBelongToUser($request->id, $this->electriciryProvider)){
            //view record 
            $record = $this->electriciryProvider->show($request->id); 
            return view('document.electricity.edit' ,['record' =>$record]); 
        }
        return redirect(route('document.electricity.index').'?year'.$request->year); 
    }
    /**
     * update electricity bill action 
     * @param Request $request client request (to get electricity bill id and data to be update)
     * @return mixed back to previous page
     */
    public function update(UpdateElectricityRequest $request){
        //make sure that is this record belong to current user
        $record = $this->electriciryProvider->show($request->id); 
        //prepearing data 
        if ($this->isBelongToUser($request->id , $this->electriciryProvider)){
            $data=[
                'release_date'=>$request->release_date,
                'consumption'=>$request->consumption,
                'amount'=>$request->amount,
                'month'=>$request->month,
                'year'=>$request->year,
                'notes'=>$request->notes
            ]; 
            $this->electriciryProvider->update($data , $request->id); 
            //upload and update image  
            if ($request->has('image')){
                $data['image'] = $this->uploadImage($request->file('image'), 'electricity' , $this->electriciryProvider, $request->id); 
            }
            //update record in database
            $this->electriciryProvider->update($data ,$request->id); 
            //redirect to documents page
            $message = 'The Bill of ( '.MONTHS[$request->month-1].' / '.$request->year.' ) has been updated. '; 
            return redirect(route('document.electricity.index').'?year='.$request->year)->with(['ok'=>$message]); 
        }
        return back(); 
    }
}
