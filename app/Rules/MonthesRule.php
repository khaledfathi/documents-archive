<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MonthesRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $monthes = json_decode($value,true); 
        if(!$monthes){
            $fail ('Select a month or more.  '); 
        }else {
            foreach($monthes as $month){
                if ($month >12 || $month < 1 ){
                    $fail('Invalid month value'); 
                }
            }
        }
    }
}
