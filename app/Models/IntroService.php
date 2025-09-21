<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class IntroService extends BaseModel
{
    use HasTranslations;
    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = ['title' , 'description'];
    public $translatable = ['title' , 'description'];
}
