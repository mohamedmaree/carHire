<?php

namespace App\Models;

use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;

class Settlement extends BaseModel
{
    use UploadTrait;
    const IMAGEPATH = 'settlements' ;
    const PERMISSIONS_NOT_APPLIED = false;


    protected $fillable = [
        'transactionable_id',
        'transactionable_type',
        'amount' ,
        'status' ,
        'image'
    ];

    public function transactionable() {
        //? rel with users, admins, providers, delegates
        return $this->morphTo();
    }

    public function getImagePathAttribute() {
        $image = $this->getImage($this->attributes['image'], 'settlements');
        return $image;
    }

    public static function boot() {
        parent::boot();
        /* creating, created, updating, updated, deleting, deleted, forceDeleted, restored */

        static::deleted(function($model) {
            $model->deleteFile($model->attributes['image'], 'settlements');
        });

    }

}
