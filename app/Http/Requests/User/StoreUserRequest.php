<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'=>'required|unique:users', 
            'email'=>'required|unique:users',
            'password'=>'required|confirmed|min:8',
            'image'=>'nullable|mimes:jpg,jpeg,png,webp,bmp,tiff|file|max:512'
        ];
    }
}
