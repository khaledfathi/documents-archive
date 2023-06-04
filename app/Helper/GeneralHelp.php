<?php
namespace App\Helper;
use Illuminate\Support\Facades\Storage; 

/**
 * 
 */
trait  GeneralHelp {
    /**
     * handle user's image upload 
     * @param mixed $imageFile image file - get it from request 
     * @param string $path path to save the new image , (string should NOT end with / )
     * @param mixed $provider repository service provider (repository)
     * @param int $recordId record id , used to delete old image for this record 
     * @return string the image file name 
     */ 
    public function uploadImage(mixed $imageFile ,string $path,  mixed $provider , int $recordId=null ):string 
    {
        if ($recordId){
            //delete old image 
            $oldImageFileName = $provider->show($recordId)->image; 
            Storage::disk('public')->delete($path.'/'.$oldImageFileName); 
        }
        //store new image
        $fileName= random_int(0,999).'_'.time().'.'.$imageFile->getClientOriginalExtension(); 
        $imageFile->storeAs($path, $fileName ,'public');
        //return the new file name 
        return $fileName;
    }
    /**
     * check if this record belong to the current logeding user or not 
     * @param int $recordId record id 
     * @param mixed $provider repository service provider (repository)
     * @return bool true = belong to user | false = NOT belong to user
     */
    public  function isBelongToUser(int $recordId , mixed $provider): bool 
    {
        $record = $provider->show($recordId); 
        if ($record){
            return ($record->user_id == auth()->user()->id); 
        }
        return false ; 
    }

}