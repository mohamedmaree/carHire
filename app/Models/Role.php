<?php

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Role extends \Spatie\Permission\Models\Role
{
    use  HasTranslations, SoftDeletes;
    const PERMISSIONS_NOT_APPLIED = false;
    public $translatable = [ 'name' ];

    public const DEFAULT_ROLE_SUPER_ADMIN = 'Super Admin';
    public const DEFAULT_ROLE = [
        self::DEFAULT_ROLE_SUPER_ADMIN,
    ];

    public const ADDITIONAL_PERMISSIONS = [];
    protected $fillable = [ 'id', 'name', 'name_ar', 'guard_name' ];
    protected array $filters = [ 'keyword' ];
    protected array $searchable = [ 'name' ];
    public array $restrictedRelations = [ 'users' ];
    protected $appends = [ 'translated_name' ];

    public function getTranslatedNameAttribute()
    {
        if (app()->getLocale() == 'en') {
            return $this->attributes['name'];
        } else {
            return $this->name_ar;
        }
    }

    public function scopeSearch($query, $searchArray = [])
    {
        $query->where(function ($query) use ($searchArray) {
            if ($searchArray) {
                foreach ($searchArray as $key => $value) {
                    if (str_contains($key, '_id')) {
                        if ($value != null) {
                            $query->Where($key, $value);
                        }
                    } elseif ($key == 'order') {
                    } elseif ($key == 'created_at_min') {
                        if ($value != null) {
                            $query->WhereDate('created_at', '>=', $value);
                        }
                    } elseif ($key == 'created_at_max') {
                        if ($value != null) {
                            $query->WhereDate('created_at', '<=', $value);
                        }
                    } else {
                        if ($value != null) {
                            $query->Where($key, 'like', '%' . $value . '%');
                        }
                    }
                }
            }
        });
        return $query->orderBy('created_at', request()->searchArray && request()->searchArray['order'] ? request()->searchArray['order'] : 'DESC');
    }
}
