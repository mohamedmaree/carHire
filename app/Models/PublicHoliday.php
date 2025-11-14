<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class PublicHoliday extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'public_holidays';

    protected $fillable = [
        'name', 'date', 'year', 'is_active', 'sort_order'
    ];

    public $translatable = ['name'];

    protected $casts = [
        'date' => 'date',
        'year' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('date')->orderBy('sort_order');
    }

    public function scopeByYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeByDate($query, $date)
    {
        return $query->whereDate('date', $date);
    }

    /**
     * Check if a date is a public holiday
     */
    public static function isHoliday($date)
    {
        return static::active()
            ->whereDate('date', $date)
            ->first();
    }

    /**
     * Get all holidays for a specific year
     */
    public static function getHolidaysByYear($year)
    {
        return static::active()
            ->byYear($year)
            ->ordered()
            ->get();
    }
}
