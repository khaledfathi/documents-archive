<?php

namespace App\Http\Controllers\Document;

use App\Helper\GeneralHelp;
use App\Http\Controllers\Controller;
use App\Http\Requests\Document\Gas\StoreGasRequest;
use App\Http\Requests\Document\Gas\UpdateGasRequest;
use App\Repository\Contracts\Document\GasRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GasDocumentController extends Controller
{
    use GeneralHelp; 
    /**
     * Gas Service Provider [Gas repository] 
     */
    public GasRepositoryContract $gasProvider; 
    public function __construct(
      GasRepositoryContract $gasProvider  
    ){
        $this->gasProvider = $gasProvider; 
    }
    /**
     * view gas bills page 
     * @param Request $request client request
     * @return mixed  view of gas bills page [route('document.gas.index')]
     */
     public function index(Request $request){
        //set year 
        ($request->has('year'))? $currentYear = $request->year : $currentYear= CURRENT_YEAR;
        $bills = $this->gasProvider->index(auth()->user()->id , $currentYear); 
        $ConsumptionStatistics = (object)[
            'min'=>$this->gasProvider->statisticMin('consumption',$currentYear , auth()->user()->id),
            'max'=>$this->gasProvider->statisticMax('consumption',$currentYear , auth()->user()->id),
            'avg'=>$this->gasProvider->statisticAvg('consumption',$currentYear , auth()->user()->id),
        ]; 
        //statistics for amount
        $amountStatistics = (object)[
            'min'=>$this->gasProvider->statisticMin('amount', $currentYear , auth()->user()->id),
            'max'=>$this->gasProvider->statisticMax('amount', $currentYear , auth()->user()->id),
            'avg'=>$this->gasProvider->statisticAvg('amount', $currentYear , auth()->user()->id),
        ]; 
        return view('document.gas.index' , [
            'currentYear'=>$currentYear,
            'bills' => $bills,
            'amountStatistics'=>$amountStatistics,
            'consumptionStatistics'=>$ConsumptionStatistics

        ]); 
    }
    /**
     * view create new gas bill page 
     * @param Request $requset client request
     * @return mixed view of createing new gas bill page 
     */
    public function create(){
        return view('document.gas.create'); 
    }
    /**
     * store gas bill in data base 
     * @param StoreGasRequest $request client request - get the data to be store
     * @return mixed redirect to gas index page with last year value in request  
     */
    public function store(StoreGasRequest $request){
        $image = $this->uploadImage($request->file('image') ,'gas',  $this->gasProvider); 
        $data = $this->gasProvider->store([
            'user_id'=>auth()->user()->id,
            'release_date'=>$request->release_date,
            'consumption'=>$request->consumption,
            'amount'=>$request->amount,
            'month'=>$request->month,
            'year'=>$request->year,
            'image'=>$image, 
            'notes'=>$request->note
        ]);  
        $message = 'The Bill of ( '.MONTHS[$request->month-1].' / '.$request->year.' ) has been Created. '; 
        return redirect(route('document.gas.index').'?year='.$request->year)->with(['ok'=>$message]); 
    }
    /**
     * destroy gas bill action
     * @param Request $request client request (to get the gas bill id )
     * @return mixed back to previous page
     */
    public function destroy(Request $request){
        //find record to get path of image perpearing to delete it
        $record = $this->gasProvider->show($request->id); 
        //delete image before delete record 
        if ($record->image && $this->isBelongToUser($request->id , $this->gasProvider)) {
            Storage::disk('public')->delete('gas/'.$record->image); 
            $this->gasProvider->destroy($request->id , auth()->user()->id); 
        }
        return back(); 
    }
    /**
     * edit gas bill page 
     * @param Request $request client request (to get gas bill to be edit )
     * @return mixed view document.gas.edit page
     */
    public function edit (Request $request){
        //get record 
        $record = $this->gasProvider->show($request->id); 
        //check if this record belong to the current user 
        if ($this->isBelongToUser($request->id, $this->gasProvider)){
            //view record 
            $record = $this->gasProvider->show($request->id); 
            return view('document.gas.edit' ,['record' =>$record]); 
        }
        return redirect(route('document.gas.index').'?year'.$request->year); 
    }

    /**
     * update gas bill action 
     * @param UpdateGasRequest $request client request (to get gas bill id and data to be update)
     * @return mixed back to previous page
     */
    public function update(UpdateGasRequest $request){
        //make sure that is this record belong to current user
        $record = $this->gasProvider->show($request->id); 
        //prepearing data 
        if ($this->isBelongToUser($request->id , $this->gasProvider)){
            $data=[
                'release_date'=>$request->release_date,
                'consumption'=>$request->consumption,
                'amount'=>$request->amount,
                'month'=>$request->month,
                'year'=>$request->year,
                'notes'=>$request->notes
            ]; 
            $this->gasProvider->update($data , $request->id); 
            //upload and update image  
            if ($request->has('image')){
                $data['image'] = $this->uploadImage($request->file('image'), 'gas' , $this->gasProvider, $request->id); 
            }
            //update record in database
            $this->gasProvider->update($data ,$request->id); 
            //redirect to documents page
            $message = 'The Bill of ( '.MONTHS[$request->month-1].' / '.$request->year.' ) has been updated. '; 
            return redirect(route('document.gas.index').'?year='.$request->year)->with(['ok'=>$message]); 
        }
        return back(); 
    }
}
