<?php

namespace App\Http\Requests\Admin\cars;

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
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'seats' => 'required|integer|min:1|max:50',
            'bags' => 'required|integer|min:1|max:20',
            'transmission' => 'required|in:auto,manual',
            'brand' => 'nullable|string|max:191',
            'model' => 'nullable|string|max:191',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'fuel_type' => 'nullable|string|max:191',
            'engine_size' => 'nullable|numeric|min:0.1|max:10.0',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'price_packages' => 'nullable|array',
            'price_packages.*.name' => 'required_with:price_packages|string|max:191',
            'price_packages.*.description' => 'nullable|string',
            'price_packages.*.price' => 'required_with:price_packages|numeric|min:0',
            'price_packages.*.kilometer_limit' => 'nullable|integer|min:1',
            'price_packages.*.is_unlimited' => 'boolean',
            'price_packages.*.is_active' => 'boolean',
            'price_packages.*.sort_order' => 'integer|min:0',
        ];
    }
}
