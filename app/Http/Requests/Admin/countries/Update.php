<?php

namespace App\Http\Requests\Admin\countries;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'name' => 'required|array',
            'currency' => 'required|array',
            'key'                    => 'required|unique:countries,key,'.$this->country,
            'currency_code'          => 'required',//|unique:countries,currency_code,'.$this->country,
            'flag'                   => 'nullable',
        ];
    }
}
