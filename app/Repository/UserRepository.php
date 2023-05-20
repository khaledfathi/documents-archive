<?php 
namespace App\Repository;

use App\Models\User as UserModel;
use App\Repository\Contracts\UserRepositoryContracts;

class UserRepository implements UserRepositoryContracts {
    public function index ():object
    {
        return UserModel::get(); 
    }
    public function store(array $data):object
    {
        return UserModel::create($data);
    }
}