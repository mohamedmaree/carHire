<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class IntroHowWork extends BaseModel
{
    use HasTranslations;
    const PERMISSIONS_NOT_APPLIED = false;

    const IMAGEPATH = 'how_works' ; 
    protected $fillable = ['title','image'];
    public $translatable = ['title'];
    
}
