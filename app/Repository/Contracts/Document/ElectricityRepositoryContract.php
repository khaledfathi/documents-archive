<?php 
namespace App\Repository\Contracts\Document; 

interface  ElectricityRepositoryContract{
    /**
     * show index of all electricity bill for specific user
     * @param int $userId user id to get his electricity bills 
     * @param int $year filter result to show bills of this year
     * @return object opject electricity bills from database 
     */
    public function index(int $userId=null , int $year=null):object ; 
    /**
     * show index of all electricity bill for specific user
     * @param array $data associative array for data to store , keys should be identical to database coulms 
     * @return object opject or the stored record  
     */
    public function store(array $data):object; 
    /**
     * destroy electricity bill by id  
     * @param int $id id of electriciy bill 
     * @param int $userId use this user id to destroy electricity bill belong to this user
     * @return bool true for success | false for fail
     */
    public function destroy(int $id , int $userId=null):bool; 
    /**
     * show electricity bill by id 
     * @param int $id electricity bill id 
     * @return object|null return electricity bill | null 
     */
    public function show ($id):object | null ; 
    /**
     * update electricity bill 
     * @param array $data arry of data needed for update this record 
     * @param int $id id of record to be update
     * @return object|null return electricity bill | null 
     */
    public function update(array $data , int $id): bool; 
    /**
     * get the minimum value of selected column 
     * @param string $column target column to be calculate 
     * @param int $year calculate this year only 
     * @param int $userId calculate rows belong to this user id
     * @return float minimum value 
     */
    public function statisticMin (string $column , int $year=null , $userId=null ):float; 
    /**
     * get the maxmum value of selected column 
     * @param string $column target column to be calculate 
     * @param int $year calculate this year only 
     * @param int $userId calculate rows belong to this user id
     * @return float maxmum  value 
     */
    public function statisticMax (string $column , int $year=null , $userId=null ):float; 
    /**
     * get the average value of selected column 
     * @param string $column target column to be calculate 
     * @param int $year calculate this year only 
     * @param int $userId calculate rows belong to this user id
     * @return float avgerage  value 
     */
    public function statisticAvg (string $column , int $year=null , $userId=null ):float; 
}