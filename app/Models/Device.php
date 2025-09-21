<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    const PERMISSIONS_NOT_APPLIED = true;
    protected $fillable = ['device_type','device_id','morph_id' , 'morph_type'];

    public function morph(){
        return $this->morphTo();
    }
}
