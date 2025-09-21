<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Blog extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'blogs';

    protected $fillable = [
        'title', 'description', 'image', 'author', 'is_active', 'sort_order'
    ];

    public $translatable = ['title', 'description', 'author'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query) { return $query->where('is_active', true); }
    public function scopeOrdered($query) { return $query->orderBy('sort_order')->orderBy('created_at', 'desc'); }

    public function getFormattedDateAttribute()
    {
        return $this->created_at ? $this->created_at->format('F d, Y') : null;
    }

    public function getShortDescriptionAttribute()
    {
        return \Str::limit(strip_tags($this->description), 150);
    }
}
