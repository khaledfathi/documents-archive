<?php

namespace App\Http\Requests\Document\Electricity;

use App\Rules\MonthesRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreElectrictyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'release_date'=>'date|required', 
            'consumption'=>'numeric|required', 
            'amount'=>'required|integer|gt:0',
            'month'=>['required','integer','between:1,12',Rule::unique('electricity_bills')->where('year' , $this->year)] ,
            'year'=>'required|integer|gt:1900' ,
            'image'=>'required|mimes:jpg,jpge,bmp,png,tiff,webp,heif|max:10000', 
        ];
    }
    public function messages(){
        return [
            'month'=>'This month " '.MONTHS[$this->month-1].' " is already paid'
        ]; 
    }
}
