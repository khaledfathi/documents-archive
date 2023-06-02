<?php 
namespace App\Repository\Document;
use App\Models\Document\ElectricityModel;
use App\Repository\Contracts\Document\ElectricityRepositoryContract;

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
    public function destroy(int $id , int $user_id=null):bool
    {
        if ($user_id){
            return ElectricityModel::where('id' , $id)->where('user_id' , $user_id )->delete(); 
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
}