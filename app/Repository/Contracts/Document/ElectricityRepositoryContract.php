<?php 
namespace App\Repository\Contracts\Document; 

interface  ElectricityRepositoryContract{
    /**
     * show index of all electricity bill for specific user
     * @param int $userId user id to get his electricity bills 
     * @return object opject electricity bills from database 
     */
    public function index(int $userId=null):object ; 
    /**
     * show index of all electricity bill for specific user
     * @param array $data associative array for data to store , keys should be identical to database coulms 
     * @return object opject or the stored record  
     */
    public function store(array $data):object ; 

}