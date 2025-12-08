<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CustomerOpinion extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'customer_opinions';

    protected $fillable = [
        'image',
        'name',
        'opinion_text',
        'num_stars',
        'is_active',
        'sort_order'
    ];

    public $translatable = ['name', 'opinion_text'];

    protected $casts = [
        'is_active' => 'boolean',
        'num_stars' => 'integer',
        'sort_order' => 'integer',
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
}
