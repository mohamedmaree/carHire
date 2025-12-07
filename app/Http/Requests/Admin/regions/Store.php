<?php

namespace App\Http\Requests\Admin\regions;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|array',
            'country_id' => 'required|exists:countries,id',
        ];
    }
}
