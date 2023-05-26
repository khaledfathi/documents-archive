<?php 
namespace App\Repository\Log;
use App\Models\Log\UserLogModel;
use App\Repository\Contracts\Log\UserLogRepositoryContract;

class UserLogRepository implements UserLogRepositoryContract{
    public function index(int $paginate=null):object
    {
        if ($paginate){
            return UserLogModel::orderBy('time','desc')->paginate($paginate); 

        }
        return UserLogModel::orderBy('time','desc')->get(); 
    } 
    public function store(array $data):object
    {
        return UserLogModel::create($data); 
    }
    public function destroyOneRelatedToUser(int $id , int $userId):bool 
    {
        return UserLogModel::where('id' , $id)->where('user_id' , $userId)->delete(); 
    }
    public function destroyAllRelatedToUser(int $userId):bool
    {
        return UserLogModel::where('user_id' , $userId)->delete(); 
    }
}