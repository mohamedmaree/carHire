<?php

namespace App\Models;

class LogActivity extends BaseModel
{
    const PERMISSIONS_NOT_APPLIED = true;
    const ADDITIONAL_PERMISSIONS = ['read-all','read','delete'];

    protected $fillable = [
        'subject',
        'url',
        'method',
        'ip',
        'agent',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
}
