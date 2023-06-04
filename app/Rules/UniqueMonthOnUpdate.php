<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

/**
 * this validation class is for check duplicated month on update with exclude the current month in record 
 */
class UniqueMonthOnUpdate implements ValidationRule
{
    /**
     * table name
     */
    public string $table; 
    /**
     * record id
     */
    public int $id ;
    /**
     * year (from form)
     */ 
    public int $year ;
    /**
     * current logedin user id 
     */
    public $userId;  
    public function __construct(
        string $table,
        int $id,
        int $year,
        int $userId
    ){
        $this->table = $table; 
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
        $record = DB::table($this->table)->where('id' , $this->id)->where('user_id' , $this->userId)->first();
        if($record){
            if ($record->month != $value){
                $isMonthExist = DB::table($this->table)->where('year' , $this->year)->where('user_id',$this->userId)->where('month', $value)->count();
                if ($isMonthExist) {
                    $fail('This month " '.MONTHS[$value-1].' " is already paid '); 
                }
            }
        }
    }
}
