<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class RegisterRequest extends BaseApiRequest {

    protected function prepareForValidation() {
        if ($this->phone) {
            $this->merge([
                'phone' => fixPhone($this->phone),
            ]);
        }
        if ($this->country_code) {
            $this->merge([
                'country_code' => fixPhone($this->country_code),
            ]);
        }
    }

    public function rules() {
        return [
            'name'         => 'required|max:50',
            'country_code' => 'nullable|numeric|digits_between:2,5',
            'phone'        => 'nullable|numeric|digits_between:8,10|unique:users,phone,NULL,id,deleted_at,NULL',
            'email'        => 'required|email|unique:users,email,NULL,id,deleted_at,NULL|max:50',
            'birth_date'   => 'required|date|before:today',
            'password'     => 'required|min:6|max:100',
            'image'        => 'nullable',
        ];
    }
}


