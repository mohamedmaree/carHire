<?php

namespace App\Http\Requests\Admin\public_holiday;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|array',
            'date' => 'required|date|unique:public_holidays,date',
            'is_active' => 'nullable|in:1,0',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }
}
