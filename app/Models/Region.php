<?php

namespace App\Models;

use App\Models\Scopes\PublishedRegionsScope;
use Spatie\Translatable\HasTranslations;

class Region extends BaseModel
{
    use HasTranslations;

    const IMAGEPATH = 'regions';
    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = [ 'name', 'country_id' ];

    public $translatable = [ 'name' ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'region_id', 'id');
    }

    static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedRegionsScope());
    }

}
