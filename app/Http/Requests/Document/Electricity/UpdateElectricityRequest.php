<?php

namespace App\Http\Requests\Document\Electricity;

use App\Rules\UniqueMonthOnUpdate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateElectricityRequest extends FormRequest
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
            'month'=>['required','integer','between:1,12',new UniqueMonthOnUpdate('water_bills', $this->id , $this->year , auth()->user()->id)] ,
            'year'=>'required|integer|gt:1900' ,
            'image'=>'nullable|mimes:jpg,jpge,bmp,png,tiff,webp,heif|max:10000', 
        ];
    }
}
