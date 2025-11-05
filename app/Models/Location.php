<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Location extends BaseModel
{
    use SoftDeletes, HasTranslations;

    const PERMISSIONS_NOT_APPLIED = false;

    protected $fillable = [
        'name', 'address', 'caption', 'toll_delivery_fees', 'description', 'lat', 'lng', 'type', 'working_days', 'working_hours', 
        'holiday_days', 'holiday_hours', 'is_active', 'sort_order'
    ];

    public $translatable = ['name', 'address', 'caption', 'description'];

    protected $casts = [
        'lat' => 'decimal:8',
        'lng' => 'decimal:8',
        'toll_delivery_fees' => 'decimal:2',
        'working_days' => 'array',
        'holiday_days' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Relationships
    public function pickupOrders()
    {
        return $this->hasMany(Order::class, 'pickup_location_id');
    }

    public function returnOrders()
    {
        return $this->hasMany(Order::class, 'return_location_id');
    }

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
        if (!$this->working_days || empty($this->working_days)) return 'N/A';
        
        // If only one day, return as is
        if (count($this->working_days) === 1) {
            return ucfirst($this->working_days[0]);
        }
        
        // Return first and last day from the actual working_days array
        $firstDay = ucfirst($this->working_days[0]);
        $lastDay = ucfirst($this->working_days[count($this->working_days) - 1]);
        
        return $firstDay . '-' . $lastDay;
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

    public function getWorkingHoursSlotsAttribute()
    {
        if (!$this->working_hours) {
            return [];
        }

        // Parse working hours (assuming format like "10:00-20:00" or "10:00 AM - 8:00 PM")
        $hours = $this->parseWorkingHours($this->working_hours);
        
        if (!$hours) {
            return [];
        }

        $slots = [];
        $startTime = $hours['start'];
        $endTime = $hours['end'];

        // Generate 30-minute slots
        $currentTime = $startTime;
        while ($currentTime < $endTime) {
            $nextTime = $currentTime->copy()->addMinutes(30);
            
            // Don't create a slot if it would go beyond the end time
            if ($nextTime <= $endTime) {
                $slots[] = [
                    'start_time' => $currentTime->format('H:i'),
                    'end_time' => $nextTime->format('H:i'),
                    'display_time' => $currentTime->format('g:i A'),
                    'display_range' => $currentTime->format('g:i A') . ' - ' . $nextTime->format('g:i A'),
                    'is_available' => true
                ];
            }
            
            $currentTime = $nextTime;
        }

        return $slots;
    }

    private function parseWorkingHours($workingHours)
    {
        // Handle different formats of working hours
        // Format 1: "10:00-20:00"
        if (preg_match('/(\d{1,2}):(\d{2})-(\d{1,2}):(\d{2})/', $workingHours, $matches)) {
            $startHour = (int) $matches[1];
            $startMinute = (int) $matches[2];
            $endHour = (int) $matches[3];
            $endMinute = (int) $matches[4];
            
            return [
                'start' => \Carbon\Carbon::createFromTime($startHour, $startMinute),
                'end' => \Carbon\Carbon::createFromTime($endHour, $endMinute)
            ];
        }
        
        // Format 2: "10:00 AM - 8:00 PM" or similar
        if (preg_match('/(\d{1,2}):(\d{2})\s*(AM|PM)\s*-\s*(\d{1,2}):(\d{2})\s*(AM|PM)/i', $workingHours, $matches)) {
            $startHour = (int) $matches[1];
            $startMinute = (int) $matches[2];
            $startPeriod = strtoupper($matches[3]);
            $endHour = (int) $matches[4];
            $endMinute = (int) $matches[5];
            $endPeriod = strtoupper($matches[6]);
            
            // Convert to 24-hour format
            if ($startPeriod === 'PM' && $startHour != 12) {
                $startHour += 12;
            } elseif ($startPeriod === 'AM' && $startHour == 12) {
                $startHour = 0;
            }
            
            if ($endPeriod === 'PM' && $endHour != 12) {
                $endHour += 12;
            } elseif ($endPeriod === 'AM' && $endHour == 12) {
                $endHour = 0;
            }
            
            return [
                'start' => \Carbon\Carbon::createFromTime($startHour, $startMinute),
                'end' => \Carbon\Carbon::createFromTime($endHour, $endMinute)
            ];
        }
        
        return null;
    }
}
