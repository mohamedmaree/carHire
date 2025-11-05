<?php

namespace App\Models;

class CarImage extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'cars';

    protected $fillable = [
        'car_id',
        'image'
    ];

    // Relationships
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
