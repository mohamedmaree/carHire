<?php

namespace App\Http\Resources\Api\Settings;

use App\Models\IntroPartener;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IntroPartenerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->id,
            'image' => $this->image, // BaseModel already handles URL generation
        ];
    }
}
