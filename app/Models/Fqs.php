<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Fqs extends BaseModel
{
    use HasTranslations;
    const PERMISSIONS_NOT_APPLIED = false;
    protected $fillable = ['question','answer'];
    public $translatable = ['question','answer'];
    
}
