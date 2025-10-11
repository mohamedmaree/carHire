<?php

namespace App\Http\Requests\Admin\car_brands;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $carBrandId = $this->route('car_brand');
        
        return [
            'name.*' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => __('admin.name') . ' ' . __('admin.is_required'),
            'name.unique' => __('admin.name') . ' ' . __('admin.already_exists'),
            'logo.image' => __('admin.logo') . ' ' . __('admin.must_be_image'),
            'logo.mimes' => __('admin.logo') . ' ' . __('admin.must_be_jpeg_png_jpg_gif_svg'),
            'logo.max' => __('admin.logo') . ' ' . __('admin.max_size_2mb'),
            'sort_order.integer' => __('admin.sort_order') . ' ' . __('admin.must_be_number'),
            'sort_order.min' => __('admin.sort_order') . ' ' . __('admin.must_be_greater_than_zero'),
        ];
    }
}
