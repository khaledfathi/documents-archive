<?php

namespace App\Rules\Document\Electricity;

use App\Models\Document\ElectricityModel;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * this validation class is for check duplicated month on update with exclude the current month in record 
 */
class UniqueMonth implements ValidationRule
{
    /**
     * record id
     */
    public $id ;
    /**
     * year (from form)
     */ 
    public $year ;
    /**
     * current logedin user id 
     */
    public $userId;  
    public function __construct(
        int $id,
        int $year,
        int $userId
    ){
        $this->id = $id; 
        $this->year=$year; 
        $this->userId = $userId; 
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $record = ElectricityModel::where('id' , $this->id)->where('user_id' , $this->userId)->first();
        if($record->count()){
            if ($record->month != $value){
                $isMonthExist = ElectricityModel::where('year' , $this->year)->where('user_id',$this->userId)->where('month', $value)->count();
                if ($isMonthExist) {
                    $fail('This month " '.MONTHS[$value-1].' " is already paid '); 
                }
            }
        }
    }
}
