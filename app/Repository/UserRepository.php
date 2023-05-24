<?php 
namespace App\Repository;

use App\Models\User as UserModel;
use App\Repository\Contracts\UserRepositoryContracts;

/**
 * UserRepository Class 
 * Repository handle CRUD operation on 'users' table in database 
 */
class UserRepository implements UserRepositoryContracts {
    public function index(int $paginate=null):object
    {
        if ($paginate){
            return UserModel::paginate($paginate); 
        }
        return UserModel::get(); 
    }
    public function store(array $data):object
    {
        return UserModel::create($data);
    }
    public function destroy(int $id):bool 
    {
        $found = UserModel::find($id); 
        return ($found) ? $found->delete() : false ; 
    }
    public function show(int $id): object | null 
    {
        return UserModel::where('id' , $id)->first(); 
    }
}