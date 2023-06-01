<?php 
namespace App\Repository\Document;
use App\Models\Document\ElectricityModel;
use App\Repository\Contracts\Document\ElectricityRepositoryContract;

class ElectriciryRepository implements ElectricityRepositoryContract{
    public function index(int $userId=null):object
    {
        if ($userId){
            return ElectricityModel::where('user_id' , $userId)->get(); 
        }
        return ElectricityModel::get(); 
    }
    public function store(array $data):object 
    {
        return ElectricityModel::create($data); 
    } 
}