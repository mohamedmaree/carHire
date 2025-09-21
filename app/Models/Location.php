<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Location extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = [
        'name', 'address', 'lat', 'lng', 'type', 'working_days', 'working_hours', 
        'holiday_days', 'holiday_hours', 'is_active', 'sort_order'
    ];

    public $translatable = ['name', 'address'];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
        'working_days' => 'array',
        'holiday_days' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function scopeAirports($query)
    {
        return $query->where('type', 'airport');
    }

    public function scopeLocations($query)
    {
        return $query->where('type', 'location');
    }

    public function getTypeTextAttribute()
    {
        return $this->type === 'airport' ? 'Airport' : 'Location';
    }

    public function getWorkingDaysTextAttribute()
    {
        if (!$this->working_days) return 'N/A';
        
        $days = [];
        foreach ($this->working_days as $day) {
            $days[] = ucfirst($day);
        }
        return implode(', ', $days);
    }

    public function getHolidayDaysTextAttribute()
    {
        if (!$this->holiday_days) return 'N/A';
        
        $days = [];
        foreach ($this->holiday_days as $day) {
            $days[] = ucfirst($day);
        }
        return implode(', ', $days);
    }

    public function getCoordinatesAttribute()
    {
        return [
            'lat' => $this->lat,
            'lng' => $this->lng
        ];
    }

    public function getFormattedWorkingHoursAttribute()
    {
        return $this->working_hours ?: 'N/A';
    }

    public function getFormattedHolidayHoursAttribute()
    {
        return $this->holiday_hours ?: 'N/A';
    }
}
