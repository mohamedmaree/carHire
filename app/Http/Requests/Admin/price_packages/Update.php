<?php

namespace App\Http\Requests\Admin\price_packages;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'kilometer_limit' => 'nullable|integer|min:1',
            'is_unlimited' => 'boolean',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }
}
