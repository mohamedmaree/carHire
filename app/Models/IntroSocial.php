<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntroSocial extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = false;
    protected $fillable = ['key','url','icon'];
}
