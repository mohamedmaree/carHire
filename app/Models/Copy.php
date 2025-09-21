<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Copy extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'folderName' ;

    use HasTranslations; 
    protected $fillable = ['title','description' ,'image'];
    public $translatable = ['title','description'];

}
