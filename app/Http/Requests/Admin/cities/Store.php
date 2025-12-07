<?php

namespace App\Http\Requests\Admin\cities;

use Illuminate\Foundation\Http\FormRequest;

class store extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|array',
            'region_id' => 'required|exists:regions,id',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
