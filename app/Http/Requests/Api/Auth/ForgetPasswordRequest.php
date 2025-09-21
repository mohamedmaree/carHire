<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;
use Illuminate\Http\Request;

class ForgetPasswordRequest extends BaseApiRequest {
  
  protected function prepareForValidation() {
    $this->merge([
        'phone' => fixPhone($this->phone),
        'country_code' => fixPhone($this->country_code),
    ]);
  }

  public function rules() {
    return [
      'code'         => 'required|max:10',
      'country_code' => 'required|exists:users,country_code',
      'phone'        => 'required|exists:users,phone',
      'password'     => 'required|min:6|max:100',
    ];
  }
}
