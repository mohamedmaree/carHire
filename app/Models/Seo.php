<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Seo extends BaseModel
{
    use HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = [ 'key', 'meta_title', 'meta_description', 'meta_keywords' ];
    public $translatable = [ 'meta_title', 'meta_description', 'meta_keywords' ];
}
