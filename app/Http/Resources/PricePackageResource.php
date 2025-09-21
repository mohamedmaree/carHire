<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PricePackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'car_id' => $this->car_id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'formatted_price' => $this->formatted_price,
            'kilometer_limit' => $this->kilometer_limit,
            'kilometer_limit_text' => $this->kilometer_limit_text,
            'is_unlimited' => $this->is_unlimited,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'car' => new CarResource($this->whenLoaded('car')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
