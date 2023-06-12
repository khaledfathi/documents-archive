<?php

namespace App\Http\Controllers\Document;

use App\Helper\GeneralHelp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document\Water\StoreWaterRequest;
use App\Http\Requests\Document\Water\UpdateWaterRequest;
use App\Repository\Contracts\Document\WaterRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaterDocumentController extends Controller
{
    use GeneralHelp; 
    /**
     * Water Service Provider [Water repository] 
     */
    public WaterRepositoryContract $waterProvider; 
    public function __construct(
      WaterRepositoryContract $waterProvider  
    ){
        $this->waterProvider = $waterProvider; 
    }
    /**
     * view water bills page 
     * @param Request $request client request
     * @return mixed  view of water bills page [route('document.water.index')]
     */
    public function index(Request $request){
        //set year 
        ($request->has('year'))? $currentYear = $request->year : $currentYear= CURRENT_YEAR;
        $bills = $this->waterProvider->index(auth()->user()->id , $currentYear); 
        //statistics for consumption
        $ConsumptionStatistics = (object)[
            'min'=>$this->waterProvider->statisticMin('consumption',$currentYear , auth()->user()->id),
            'max'=>$this->waterProvider->statisticMax('consumption',$currentYear , auth()->user()->id),
            'avg'=>$this->waterProvider->statisticAvg('consumption',$currentYear , auth()->user()->id),
        ]; 
        //statistics for amount
        $amountStatistics = (object)[
            'min'=>$this->waterProvider->statisticMin('amount', $currentYear , auth()->user()->id),
            'max'=>$this->waterProvider->statisticMax('amount', $currentYear , auth()->user()->id),
            'avg'=>$this->waterProvider->statisticAvg('amount', $currentYear , auth()->user()->id),
        ]; 
        

        return view('document.water.index' ,[
            'currentYear'=>$currentYear,
            'bills'=>$bills,
            'amountStatistics'=>$amountStatistics,
            'consumptionStatistics'=>$ConsumptionStatistics
        ]); 
    }
    /**
     * view create new water bill page 
     * @param Request $requset client request
     * @return mixed view of createing new water bill page 
     */
    public function create(Request $request){
        return  view ('document.water.create'); 
    }
    /**
     * store water bill in data base 
     * @param StoreWaterRequest $request client request - get the data to be store
     * @return mixed redirect to water index page with last year value in request  
     */
    public function store (StoreWaterRequest $request){
        $image = $this->uploadImage($request->file('image') ,'water',  $this->waterProvider); 
        $data = $this->waterProvider->store([
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
        return redirect(route('document.water.index').'?year='.$request->year)->with(['ok'=>$message]); 
    }
    /**
     * edit water bill page 
     * @param Request $request client request (to get water bill to be edit )
     * @return mixed view document.water.edit page
     */
    public function edit (Request $request){
        //get record 
        $record = $this->waterProvider->show($request->id); 
        //check if this record belong to the current user 
        if ($this->isBelongToUser($request->id, $this->waterProvider)){
            //view record 
            $record = $this->waterProvider->show($request->id); 
            return view('document.water.edit' ,['record' =>$record]); 
        }
        return redirect(route('document.water.index').'?year'.$request->year); 
    }
    /**
     * destroy water bill action
     * @param Request $request client request (to get the water bill id )
     * @return mixed back to previous page
     */
    public function destroy(Request $request){
        //find record to get path of image perpearing to delete it
        $record = $this->waterProvider->show($request->id); 
        //delete image before delete record 
        if ($record->image && $this->isBelongToUser($request->id , $this->waterProvider)) {
            Storage::disk('public')->delete('water/'.$record->image); 
            $this->waterProvider->destroy($request->id , auth()->user()->id); 
        }
        return back(); 
    }
    /**
     * update water bill action 
     * @param Request $request client request (to get water bill id and data to be update)
     * @return mixed back to previous page
     */
    public function update(UpdateWaterRequest $request){
        //make sure that is this record belong to current user
        $record = $this->waterProvider->show($request->id); 
        //prepearing data 
        if ($this->isBelongToUser($request->id , $this->waterProvider)){
            $data=[
                'release_date'=>$request->release_date,
                'consumption'=>$request->consumption,
                'amount'=>$request->amount,
                'month'=>$request->month,
                'year'=>$request->year,
                'notes'=>$request->notes
            ]; 
            $this->waterProvider->update($data , $request->id); 
            //upload and update image  
            if ($request->has('image')){
                $data['image'] = $this->uploadImage($request->file('image'), 'water' , $this->waterProvider, $request->id); 
            }
            //update record in database
            $this->waterProvider->update($data ,$request->id); 
            //redirect to documents page
            $message = 'The Bill of ( '.MONTHS[$request->month-1].' / '.$request->year.' ) has been updated. '; 
            return redirect(route('document.water.index').'?year='.$request->year)->with(['ok'=>$message]); 
        }
        return back(); 
    }


}
