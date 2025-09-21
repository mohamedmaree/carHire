<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class SiteSetting extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = true;
    const ADDITIONAL_PERMISSIONS = ['read-all-intro' , 'read-all-dashboard'];
    protected $fillable = [ 'key', 'value' ];
}
