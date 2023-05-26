<?php 
namespace App\Repository\Contracts\Log; 

interface UserLogRepositoryContract {    
    /**
     * show index of all user's logedin logs
     * @param int $paginate set pagination value
     * @return object object of index of all user's loggedin logs 
     */
    public function index(int $paginate=null):object; 
    /**
     * Store user's Login Log information (time , ip address , user agent)
     * @param array $data associative array , each filed must be identical to the 'user_logs' database field
     * @return object the record as object model (UserLogModel object)
     */
    public function store(array $data):object; 
    /**
     * destroy log by id for specific user 
     * @param int $id log id 
     * @param int $userId current logedin user id 
     * @return bool true for success | false for fail 
     */
    public function destroyOneRelatedToUser(int $id , int $userId):bool ; 
    /**
     * destroy all logs for specific user 
     * @param int $userId current logedin user id 
     * @return bool true for success | false for fail 
     */
    public function destroyAllRelatedToUser(int $userId):bool;
}