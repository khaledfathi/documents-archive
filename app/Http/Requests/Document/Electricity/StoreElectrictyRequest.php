<?php

namespace App\Http\Requests\Document\Electricity;

use App\Rules\MonthesRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'amount'=>'numeric|required|gt:0',
            'monthes'=>new MonthesRule, 
            'image'=>'required|mimes:jpg,jpge,bmp,png,tiff,webp,heif|max:10000', 
        ];
    }
}
