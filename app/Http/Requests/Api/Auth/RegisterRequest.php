<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class RegisterRequest extends BaseApiRequest {

    protected function prepareForValidation() {
        $this->merge([
            'phone' => fixPhone($this->phone),
            'country_code' => fixPhone($this->country_code),
        ]);
    }

    public function rules() {
        return [
            'name'         => 'required|max:50',
            'country_code' => 'required|numeric|digits_between:2,5',
            'phone'        => 'required|numeric|digits_between:8,10|unique:users,phone,NULL,id,deleted_at,NULL',
            'email'        => 'nullable|email|unique:users,email,NULL,id,deleted_at,NULL|max:50',
            'password'     => 'required|min:6|max:100',
            'image'        => 'nullable',
        ];
    }
}


