<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Option extends BaseModel
{
    use SoftDeletes, HasTranslations;
    
    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'options';

    protected $fillable = [
        'name',
        'description',
        'icon',
        'price',
        'price_type',
        'is_active',
        'sort_order'
    ];

    public $translatable = ['name', 'description'];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function scopePerDay($query)
    {
        return $query->where('price_type', 'per_day');
    }

    public function scopeFlatFee($query)
    {
        return $query->where('price_type', 'flat_fee');
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        $price = '$' . number_format($this->price, 2);
        if ($this->price_type === 'per_day') {
            $price .= ' / Per Day';
        } else {
            $price .= ' Flat fee';
        }
        return $price;
    }

    public function getPriceTypeTextAttribute()
    {
        return $this->price_type === 'per_day' ? 'Per Day' : 'Flat Fee';
    }
}
