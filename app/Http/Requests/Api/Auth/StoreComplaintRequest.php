<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\BaseApiRequest;

class StoreComplaintRequest extends BaseApiRequest {

  public function rules() {
    return [
      'user_name' => 'required|max:50',
      'phone'     => 'required|max:20',
      'email'     => 'required|email|max:50',
      'complaint' => 'required|max:500',
      'car_brand_id' => 'nullable|exists:car_brands,id',
    ];
  }
}
