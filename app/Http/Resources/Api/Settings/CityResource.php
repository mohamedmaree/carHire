<?php

namespace App\Http\Resources\Api\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'country'    => $this->country->name??'',
            'country_id' => (int) $this->country_id,
        ];
    }
}
