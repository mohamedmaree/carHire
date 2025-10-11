<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use App\Traits\UploadTrait;

class Option extends BaseModel
{
    use SoftDeletes, HasTranslations,UploadTrait;
    
    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'options';

    protected $fillable = [
        'name',
        'description',
        'short_description',
        'icon',
        'price',
        'price_type',
        'is_active',
        'quantity_required',
        'is_required',
        'sort_order',
        'parent_id',
        'is_parent'
    ];

    public $translatable = ['name', 'description', 'short_description'];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'quantity_required' => 'boolean',
        'is_required' => 'boolean',
        'sort_order' => 'integer',
        'short_description' => 'array',
        'is_parent' => 'boolean'
    ];

    // Relationships
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'car_rental_order_options')->withPivot('quantity', 'price', 'total_price');
    }

    public function parent()
    {
        return $this->belongsTo(Option::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Option::class, 'parent_id')->orderBy('sort_order');
    }

    public function activeChildren()
    {
        return $this->hasMany(Option::class, 'parent_id')->where('is_active', true)->orderBy('sort_order');
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

    public function scopePerDay($query)
    {
        return $query->where('price_type', 'per_day');
    }

    public function scopeFlatFee($query)
    {
        return $query->where('price_type', 'flat_fee');
    }

    public function scopeRequired($query)
    {
        return $query->where('is_required', true);
    }

    public function scopeOptional($query)
    {
        return $query->where('is_required', false);
    }

    // Hierarchical scopes
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id')->where('is_parent', true);
    }

    public function scopeChildren($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeRootOptions($query)
    {
        return $query->whereNull('parent_id');
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

    public function getIsChildAttribute()
    {
        return !is_null($this->parent_id);
    }

    public function getHasChildrenAttribute()
    {
        return $this->children()->count() > 0;
    }

    public function getIconAttribute()
    {
        if ($this->attributes['icon']) {
            $image = $this->getImage($this->attributes['icon'], static::IMAGEPATH);
        } else {
            $image = '';
        }
        return $image;
    } 

    public function setIconAttribute($value) {
        if (null != $value && is_file($value) ) {
            isset($this->attributes['icon']) ? $this->deleteFile($this->attributes['icon'] , static::IMAGEPATH) : '';
            $this->attributes['icon'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }
}
