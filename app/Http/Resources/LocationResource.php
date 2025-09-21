<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'address' => $this->address,
            'lat' => $this->lat,
            'lng' => $this->lng,
            'type' => $this->type,
            'type_text' => $this->type_text,
            'working_days' => $this->working_days,
            'working_days_text' => $this->working_days_text,
            'working_hours' => $this->working_hours,
            'formatted_working_hours' => $this->formatted_working_hours,
            'holiday_days' => $this->holiday_days,
            'holiday_days_text' => $this->holiday_days_text,
            'holiday_hours' => $this->holiday_hours,
            'formatted_holiday_hours' => $this->formatted_holiday_hours,
            'coordinates' => $this->coordinates,
            'is_active' => $this->is_active,
            'sort_order' => $this->sort_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
