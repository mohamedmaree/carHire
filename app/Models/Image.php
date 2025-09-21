<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;

class Image extends BaseModel
{
    use HasTranslations;
    const IMAGEPATH = 'images' ;
    const PERMISSIONS_NOT_APPLIED = false;
    protected $fillable = ['name','start_date','end_date','link','sort','is_active','image'];
    public $translatable = ['name'];
}
