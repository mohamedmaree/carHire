<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'name' => $this->name,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'images' => $this->whenLoaded('images', function () {
                return $this->images->map(function ($carImage) {
                    return [
                        'id' => $carImage->id,
                        'image' => $carImage->image,
                    ];
                });
            }),
            'seats' => $this->seats,
            'bags' => $this->bags,
            'transmission' => $this->transmission,
            'transmission_text' => $this->transmission_text,
            'brand' => $this->brand,
            'model' => $this->model,
            'year' => $this->year,
            'fuel_type' => $this->fuel_type,
            'engine_size' => $this->engine_size,
            'refundable_deposit' => $this->refundable_deposit,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'formatted_price' => $this->formatted_price,
            'features' => $this->formatted_features,
            'price_packages' => PricePackageResource::collection($this->whenLoaded('pricePackages')),
            'active_price_packages' => PricePackageResource::collection($this->whenLoaded('activePricePackages')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
