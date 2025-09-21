<?php

namespace App\Models;


class IntroMessages extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = false;
    protected $fillable = ['name','phone','email','message'];
}
