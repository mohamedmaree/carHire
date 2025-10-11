<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'description' => $this->description,
            'short_description' => $this->short_description,
            'icon' => $this->icon,
            'price' => $this->price,
            'formatted_price' => $this->formatted_price,
            'price_type' => $this->price_type,
            'price_type_text' => $this->price_type_text,
            'is_active' => $this->is_active,
            'quantity_required' => $this->quantity_required,
            'sort_order' => $this->sort_order,
            
            // Hierarchical information
            'parent_id' => $this->parent_id,
            'is_parent' => $this->is_parent,
            'is_child' => $this->is_child,
            'has_children' => $this->has_children,
            
            // Parent option information
            'parent' => $this->whenLoaded('parent', function () {
                return [
                    'id' => $this->parent->id,
                    'name' => $this->parent->name,
                    'description' => $this->parent->description,
                    'short_description' => $this->parent->short_description,
                    'icon' => $this->parent->icon,
                    'price' => $this->parent->price,
                    'formatted_price' => $this->parent->formatted_price,
                    'price_type' => $this->parent->price_type,
                    'price_type_text' => $this->parent->price_type_text,
                ];
            }),
            
            // Children options
            'children' => $this->whenLoaded('children', function () {
                return $this->children->map(function ($child) {
                    return [
                        'id' => $child->id,
                        'name' => $child->name,
                        'description' => $child->description,
                        'short_description' => $child->short_description,
                        'icon' => $child->icon,
                        'price' => $child->price,
                        'formatted_price' => $child->formatted_price,
                        'price_type' => $child->price_type,
                        'price_type_text' => $child->price_type_text,
                        'is_active' => $child->is_active,
                        'quantity_required' => $child->quantity_required,
                        'sort_order' => $child->sort_order,
                    ];
                });
            }),
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
