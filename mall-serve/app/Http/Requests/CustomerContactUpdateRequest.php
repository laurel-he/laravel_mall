<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


//https://laravel-china.org/articles/5558/laravel-http-the-use-of-restful-style-routing-and-source-code-analysis
class CustomerContactUpdateRequest extends FormRequest
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
//         https://laravel-china.org/articles/5558/laravel-http-the-use-of-restful-style-routing-and-source-code-analysis
//         $id = $this->id;
        $route = $this->route();
        $parameters = $route->parameters();
        $parmName = $route->parameterNames();
        $id = $parameters[$parmName[0]];
        
        return [
            'phone' => [
                'required',
                'size:11',
                'string',
                Rule::unique('customer_contact')->ignore($this->query('id'))
            ],
            'qq'    => [
                'nullable',
                Rule::unique('customer_contact')->ignore($id, 'id')
            ],
            'wexin' => [
                'nullable',
                Rule::unique('customer_contact')->ignore($id)
            ],
        ];
    }
}
