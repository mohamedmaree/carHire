<?php

namespace App\Http\Requests\Admin\blog;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'          => 'required|array',
            'title.ar'       => 'required|string|max:255',
            'title.en'       => 'required|string|max:255',
            'description'    => 'required|array',
            'description.ar' => 'required|string',
            'description.en' => 'required|string',
            'author'         => 'required|array',
            'author.ar'      => 'required|string|max:255',
            'author.en'      => 'required|string|max:255',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active'      => 'nullable|in:1,0',
            'sort_order'     => 'nullable|integer',
        ];
    }
}
