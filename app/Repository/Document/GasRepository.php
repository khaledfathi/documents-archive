<?php
namespace App\Repository\Document;
use App\Models\Document\GasModel;
use App\Repository\Contracts\Document\GasRepositoryContract; 

class GasRepository implements GasRepositoryContract {
     //PRIVATE METHODS
    private  function prepearStatistic(int $year=null , int $userId):object 
    {
        $result=[]; 
        if ($userId && $year){
            $record = GasModel::where('user_id' , $userId)->where('year', $year); 

        }elseif($userId){
            $record = GasModel::where('user_id' , $userId);  

        }elseif($year){
            $record = GasModel::where('year', $year); 

        }else{
            $record = new GasModel ; 

        }
        return $record; 
    }
   
    //PUBLIC METHODS

    public function index(int $userId=null , int $year=null):object  
    {
    if ($userId){
            if ($year){
                return GasModel::where('user_id' , $userId)->where('year',$year)->
                    orderBy('month')->get(); 
            }else {
                return GasModel::where('user_id' , $userId)->orderBy('month')->get(); 
            }
        }
        return GasModel::orderBy('year')->orderBy('month')->get(); 
    }
    public function store(array $data):object{
        return GasModel::create($data); 
    }
    public function destroy(int $id , int $userId=null):bool
    {
        if ($userId){
            return GasModel::where('id' , $id)->where('user_id' , $userId )->delete(); 
        }
        $found = GasModel::find($id); 
        return ($found)? $found->delete() : false  ; 
    } 
    public function show ($id):object | null 
    {
        return GasModel::where('id',$id)->first(); 
    }
    public function update(array $data , int $id): bool
    {
        $found = GasModel::find($id); 
        return ($found) ? $found->update($data) : false ; 
    } 

    public function statisticMin (string $column , int $year=null , $userId=null):float
    {
        $record = $this->prepearStatistic($year , $userId)->select($column)->orderBy($column , 'asc')->first();
        return ($record) ? $record->$column : 0 ; 
    }
   public function statisticMax (string $column , int $year=null , $userId=null):float
    {
        $record = $this->prepearStatistic($year , $userId)->orderBy($column , 'desc')->max($column);
        return ($record) ? $record : 0 ; 
    }
   public function statisticAvg (string $column , int $year=null , $userId=null):float
    {
        $record = $this->prepearStatistic($year , $userId)->orderBy($column , 'asc')->avg($column);
        return ($record) ? round($record , 2 ) : 0 ; 
    }


}