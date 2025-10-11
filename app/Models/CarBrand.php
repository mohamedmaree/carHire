<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CarBrand extends BaseModel
{
    use HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'car_brands';

    protected $fillable = [
        'name',
        'logo',
        'is_active',
        'sort_order'
    ];

    public $translatable = ['name'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function getLogoAttribute()
    {
        if (isset($this->attributes['logo'])) {
            $image = $this->getImage($this->attributes['logo'], static::IMAGEPATH);
        } else {
            $image = $this->defaultImage(static::IMAGEPATH);
        }
        return $image;
    }

    public function setLogoAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['logo']) ? $this->deleteFile($this->attributes['logo'], static::IMAGEPATH) : '';
            $this->attributes['logo'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }

    // Relationships
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'car_brand_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
