<?php

namespace App\Http\Requests\Admin\options;

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
            'name' => 'required',
            'description' => 'required',
            'short_description' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:per_day,flat_fee',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }
}
