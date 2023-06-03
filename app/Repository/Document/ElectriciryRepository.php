<?php 
namespace App\Repository\Document;
use App\Models\Document\ElectricityModel;
use App\Repository\Contracts\Document\ElectricityRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class ElectriciryRepository implements ElectricityRepositoryContract{
    public function index(int $userId=null , int $year=null):object 
    {        
        if ($userId){
            if ($year){
                return ElectricityModel::where('user_id' , $userId)->where('year',$year)->
                    orderBy('month')->get(); 
            }else {
                return ElectricityModel::where('user_id' , $userId)->orderBy('month')->get(); 
            }
        }
        return ElectricityModel::orderBy('year')->orderBy('month')->get(); 
    }
    public function store(array $data):object 
    {
        return ElectricityModel::create($data); 
    } 
    public function destroy(int $id , int $userId=null):bool
    {
        if ($userId){
            return ElectricityModel::where('id' , $id)->where('user_id' , $userId )->delete(); 
        }
        $found = ElectricityModel::find($id); 
        return ($found)? $found->delete() : false  ; 
    } 
    public function show ($id):object | null
    {
        return ElectricityModel::where('id',$id)->first(); 
    }

    public function update(array $data , int $id): bool
    {
        $found = ElectricityModel::find($id); 
        return ($found) ? $found->update($data) : false ; 
    } 

    private  function prepearStatistic(int $year=null , int $userId):object 
    {
        $result=[]; 
        if ($userId && $year){
            $record = ElectricityModel::where('user_id' , $userId)->where('year', $year); 
        }elseif($userId){
            $record = ElectricityModel::where('user_id' , $userId);  
        }elseif($year){
            $record = ElectricityModel::where('year', $year); 
        }else{
            $record = new ElectricityModel; 
        }
        return $record; 
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