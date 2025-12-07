<?php

namespace App\Http\Requests\Admin\blog;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'title'          => 'required|array',
            'description'    => 'required|array',
            'author'         => 'required|array',
            'image'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active'      => 'nullable|in:1,0',
            'sort_order'     => 'nullable|integer',
            'tags_input'     => 'nullable|string',
        ];
    }
}
