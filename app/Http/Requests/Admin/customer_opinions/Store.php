<?php

namespace App\Http\Requests\Admin\customer_opinions;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|array',
            'opinion_text' => 'required|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'num_stars' => 'required|integer|min:1|max:5',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }
}
