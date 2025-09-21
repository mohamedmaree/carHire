<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMember extends Model
{

    const PERMISSIONS_NOT_APPLIED = true;
    protected $fillable = [
        'room_id',
        'memberable_id',
        'memberable_type',
    ];

    public function memberable()
    {
        return $this->morphTo();
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
