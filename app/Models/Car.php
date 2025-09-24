<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Car extends BaseModel
{
    use SoftDeletes, HasTranslations;
    
    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'cars';

    protected $fillable = [
        'name',
        'description', 
        'image',
        'seats',
        'bags',
        'transmission',
        'brand',
        'model',
        'year',
        'fuel_type',
        'engine_size',
        'is_active',
        'sort_order'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'is_active' => 'boolean',
        'seats' => 'integer',
        'bags' => 'integer',
        'year' => 'integer',
        'engine_size' => 'decimal:1',
        'sort_order' => 'integer'
    ];

    // Relationships
    public function pricePackages()
    {
        return $this->hasMany(PricePackage::class)->orderBy('sort_order');
    }

    public function activePricePackages()
    {
        return $this->hasMany(PricePackage::class)->where('is_active', true)->orderBy('sort_order');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    // Accessors
    public function getTransmissionTextAttribute()
    {
        return $this->transmission === 'auto' ? 'Auto' : 'Manual';
    }

    public function getFormattedPriceAttribute()
    {
        $limitedPackage = $this->pricePackages()->where('is_unlimited', false)->first();
        return $limitedPackage ? '$' . number_format($limitedPackage->price, 2) : 'N/A';
    }
}
