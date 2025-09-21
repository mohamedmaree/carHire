<?php

namespace App\Models;

class IntroPartener extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = ['image'];
    const IMAGEPATH = 'parteners' ; 
}
