<?php 
namespace App\Repository;

use App\Models\User as UserModel;
use App\Repository\Contracts\UserRepositoryContracts;

class UserRepository implements UserRepositoryContracts {
    public function index ():object
    {
        return UserModel::get(); 
    }
}