<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class UpdateProfileRequest extends BaseApiRequest {

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
      'country_code' => 'sometimes|required|numeric|digits_between:2,5',
      'phone'        => 'sometimes|required|numeric|digits_between:7,9|unique:users,phone,'.auth()->id().',id,deleted_at,NULL',
      'email'        => 'sometimes|required|email|max:50|unique:users,email,'.auth()->id().',id,deleted_at,NULL',
      // 'active'       => '',
      'image'        => 'nullable',
    ];
  }



}
