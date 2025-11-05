<?php

namespace App\Http\Requests\Admin\cars;

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
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'seats' => 'required|integer|min:1|max:50',
            'bags' => 'required|integer|min:1|max:20',
            'transmission' => 'required|in:auto,manual',
            'brand' => 'nullable|string|max:191',
            'model' => 'nullable|string|max:191',
            'year' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'fuel_type' => 'nullable|string|max:191',
            'engine_size' => 'nullable',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
            'price_packages' => 'nullable|array',
            'price_packages.*.name' => 'required_with:price_packages|max:191',
            'price_packages.*.description' => 'nullable',
            'price_packages.*.price' => 'required_with:price_packages|numeric|min:0',
            'price_packages.*.kilometer_limit' => 'nullable|integer|min:1',
            'price_packages.*.is_unlimited' => 'boolean',
            'price_packages.*.is_active' => 'boolean',
            'price_packages.*.sort_order' => 'integer|min:0',
            'car_images' => 'nullable|array',
            'car_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
