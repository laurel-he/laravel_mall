<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrePotCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'eng_name' => 'required|unique:entrepot_basic|max:2'
        ];
    }
    
    public function messages()
    {
        return [
            'eng_name.unique' => '英文简称已使用了',
        ];
    }
}
