<?php
namespace App\Repository\Contracts;
/**
 *Interface for UserRepository class
 *
 */ 
interface UserRepositoryContracts {
    /**
     * get all users 
     * @param int $paginate the count of paginate rows
     * @return object Eloquent Object contains users
     */
    public function index(int $paginate=null):object;
    /**
     * store new user
     * @param array $data associative array , each key must be identical to name of field 
     * @return object Eloquent Object contains the new user that has been stored 
     */
    public function store(array $data):object;  
    /**
     * destroy user by id 
     * @param int $id user id 
     * @return bool true for success | false for fail 
     */
    public function destroy(int $id): bool; 
    /**
     * get user by id 
     * @param int $id user id 
     * @return object|null Eloquent Object if user got found | null 
     */
    public function show(int $id): object | null ;
    /**
     * update user by id 
     * @param array $data associative array to update record , each key must be identical to name of field  
     * @param int $id user id that will be updated 
     * @return bool true for succsess | false for failed
     */
    public function update(array $data , int $id ):bool ; 
}