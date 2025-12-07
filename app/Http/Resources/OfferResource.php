<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'discount_amount' => $this->discount_amount,
            'formatted_discount' => $this->formatted_discount,
            'discount_type' => $this->coupon ? $this->coupon->type : null, // 'ratio' or 'number' (fixed)
            'coupon_id' => (int) $this->coupon_id,
            'coupon' => $this->whenLoaded('coupon', function () {
                return [
                    'id' => $this->coupon->id,
                    'coupon_num' => $this->coupon->coupon_num,
                    'type' => $this->coupon->type,
                    'discount' => $this->coupon->discount,
                    'max_discount' => $this->coupon->max_discount,
                    'expiry_date' => $this->coupon->expiry_date?->format('Y-m-d'),
                    'status' => $this->coupon->status,
                ];
            }),
            'coupon_code' => $this->whenLoaded('coupon', function () {
                return $this->coupon->coupon_num;
            }),
            'is_active' => $this->is_active,
            'show_in_popup' => $this->show_in_popup,
            'sort_order' => $this->sort_order,
            'formatted_date' => $this->formatted_date,
            'short_description' => $this->short_description,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}