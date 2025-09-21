<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PricePackage extends BaseModel
{
    use SoftDeletes, HasTranslations;
    
    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = [
        'car_id',
        'name',
        'description',
        'price',
        'kilometer_limit',
        'is_unlimited',
        'is_active',
        'sort_order'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
        'kilometer_limit' => 'integer',
        'is_unlimited' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Relationships
    public function car()
    {
        return $this->belongsTo(Car::class);
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

    public function scopeLimited($query)
    {
        return $query->where('is_unlimited', false);
    }

    public function scopeUnlimited($query)
    {
        return $query->where('is_unlimited', true);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    public function getKilometerLimitTextAttribute()
    {
        if ($this->is_unlimited) {
            return 'Unlimited Km';
        }
        return $this->kilometer_limit . 'Km/day';
    }
}
