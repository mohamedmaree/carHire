<?php

namespace App\Http\Requests\Admin\Seo;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'key' => 'required',
            'meta_title' => 'required|array',
            'meta_description' => 'required|array',
            'meta_keywords' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'key.required' => 'ال key مطلوب',
        ];
    }
}
