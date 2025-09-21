<?php

namespace App\Http\Requests\Admin\locations;

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
            'name.*' => 'required|string|max:255',
            'address' => 'required|array',
            'address.*' => 'required|string|max:500',
            'lat' => 'nullable|numeric|between:-90,90',
            'lng' => 'nullable|numeric|between:-180,180',
            'type' => 'required|in:airport,location',
            'working_days' => 'nullable|array',
            'working_days.*' => 'string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'working_hours' => 'nullable|string|max:100',
            'holiday_days' => 'nullable|array',
            'holiday_days.*' => 'string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'holiday_hours' => 'nullable|string|max:100',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ];
    }
}
