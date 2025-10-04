<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends BaseModel
{
    use HasFactory, SoftDeletes;

    const PERMISSIONS_NOT_APPLIED = false;
    const IMAGEPATH = 'orders';
    
    protected $table = 'car_rental_orders';

    protected $fillable = [
        // Location Information
        'pickup_location_id', 'pickup_address', 'return_location_id', 'return_address',
        'same_return_location', 'is_airport_pickup', 'is_airport_return',
        
        // Date and Time Information
        'pickup_date', 'pickup_time', 'return_date', 'return_time',
        
        // Flight Information (for airport locations)
        'flight_arrival_date', 'flight_arrival_time', 'flight_number_arrival', 'flight_airline_arrival',
        'flight_departure_date', 'flight_departure_time', 'flight_number_departure', 'flight_airline_departure',
        
        // Customer Demographics
        'customer_age', 'customer_country_id',
        
        // Car and Options
        'car_id', 'price_package_id', 'rental_days', 'total_amount', 'subtotal_amount',
        
        // Coupon Information
        'coupon_code', 'coupon_discount_amount', 'coupon_discount_percentage',
        
        // Customer Information
        'first_name', 'last_name', 'email', 'phone', 'address', 'city_id', 'country_id', 'zip', 'birthdate','user_id',
        
        // Driver License Information
        'driver_license_number', 'driver_license_expiration_date', 'driver_license_image',
        
        // International Customer Information
        'current_country_address', 'passport_expiration_date', 'passport_image',
        
        // Client Signature
        'client_signature',
        
        // Order Status and Management
        'order_status', 'payment_status', 'payment_method', 'payment_reference',
        'notes', 'admin_notes', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'flight_arrival_date' => 'date',
        'flight_departure_date' => 'date',
        'driver_license_expiration_date' => 'date',
        'passport_expiration_date' => 'date',
        'birthdate' => 'date',
        'same_return_location' => 'boolean',
        'is_airport_pickup' => 'boolean',
        'is_airport_return' => 'boolean',
        'rental_days' => 'integer',
        'total_amount' => 'decimal:2',
        'subtotal_amount' => 'decimal:2',
        'coupon_discount_amount' => 'decimal:2',
        'coupon_discount_percentage' => 'decimal:2',
        'customer_age' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'order_status' => OrderStatus::class,
        'payment_status' => PaymentStatus::class,
        // ID fields cast to integers
        'pickup_location_id' => 'integer',
        'return_location_id' => 'integer',
        'customer_country_id' => 'integer',
        'car_id' => 'integer',
        'city_id' => 'integer',
        'country_id' => 'integer',
        'user_id' => 'integer',
        'price_package_id' => 'integer',
    ];

    // Relationships
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function pricePackage()
    {
        return $this->belongsTo(PricePackage::class);
    }

    public function pickupLocation()
    {
        return $this->belongsTo(Location::class, 'pickup_location_id');
    }

    public function returnLocation()
    {
        return $this->belongsTo(Location::class, 'return_location_id');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'car_rental_order_options')->withPivot('quantity', 'price', 'total_price');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_code', 'coupon_num');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customerCountry()
    {
        return $this->belongsTo(Country::class, 'customer_country_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('order_status', $status);
    }

    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    public function scopeAirportPickups($query)
    {
        return $query->where('is_airport_pickup', true);
    }

    public function scopeRegularPickups($query)
    {
        return $query->where('is_airport_pickup', false);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFormattedPickupDateTimeAttribute()
    {
        return $this->pickup_date ? $this->pickup_date->format('M d, Y') . ' ' . $this->pickup_time : null;
    }

    public function getFormattedReturnDateTimeAttribute()
    {
        return $this->return_date ? $this->return_date->format('M d, Y') . ' ' . $this->return_time : null;
    }

    public function getFormattedTotalAmountAttribute()
    {
        return '$' . number_format($this->total_amount, 2);
    }

    public function getFormattedSubtotalAmountAttribute()
    {
        return '$' . number_format($this->subtotal_amount, 2);
    }

    public function getOrderStatusTextAttribute()
    {
        return $this->order_status->getLabel();
    }

    public function getPaymentStatusTextAttribute()
    {
        return $this->payment_status->getLabel();
    }

    public function getPickupLocationTextAttribute()
    {
        if ($this->pickup_location_id) {
            return $this->pickupLocation->name;
        }
        return $this->pickup_address;
    }

    public function getReturnLocationTextAttribute()
    {
        if ($this->same_return_location) {
            return $this->pickup_location_text;
        }
        if ($this->return_location_id) {
            return $this->returnLocation->name;
        }
        return $this->return_address;
    }

    public function getHasFlightInfoAttribute()
    {
        return $this->is_airport_pickup || $this->is_airport_return;
    }

    public function getFormattedFlightArrivalDateTimeAttribute()
    {
        if ($this->flight_arrival_date && $this->flight_arrival_time) {
            return $this->flight_arrival_date->format('M d, Y') . ' ' . $this->flight_arrival_time;
        }
        return null;
    }

    public function getFormattedFlightDepartureDateTimeAttribute()
    {
        if ($this->flight_departure_date && $this->flight_departure_time) {
            return $this->flight_departure_date->format('M d, Y') . ' ' . $this->flight_departure_time;
        }
        return null;
    }

    public function getOptionsTotalAttribute()
    {
        return $this->options->sum('pivot.total_price');
    }

    public function getFormattedOptionsTotalAttribute()
    {
        return '$' . number_format($this->options_total, 2);
    }

    public function getFormattedCouponDiscountAttribute()
    {
        if ($this->coupon_discount_amount) {
            return '$' . number_format($this->coupon_discount_amount, 2);
        }
        if ($this->coupon_discount_percentage) {
            return $this->coupon_discount_percentage . '%';
        }
        return null;
    }

    // Image accessors and mutators for driver license and passport
    public function getDriverLicenseImageAttribute()
    {
        if (isset($this->attributes['driver_license_image'])) {
            return $this->getImage($this->attributes['driver_license_image'], static::IMAGEPATH);
        }
        return $this->defaultImage(static::IMAGEPATH);
    }

    public function setDriverLicenseImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['driver_license_image']) ? $this->deleteFile($this->attributes['driver_license_image'], static::IMAGEPATH) : '';
            $this->attributes['driver_license_image'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }

    public function getPassportImageAttribute()
    {
        if (isset($this->attributes['passport_image'])) {
            return $this->getImage($this->attributes['passport_image'], static::IMAGEPATH);
        }
        return $this->defaultImage(static::IMAGEPATH);
    }

    public function setPassportImageAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['passport_image']) ? $this->deleteFile($this->attributes['passport_image'], static::IMAGEPATH) : '';
            $this->attributes['passport_image'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        }
    }

    public function getClientSignatureAttribute()
    {
        if (isset($this->attributes['client_signature'])) {
            return $this->getImage($this->attributes['client_signature'], static::IMAGEPATH);
        }
        return $this->defaultImage(static::IMAGEPATH);
    }

    public function setClientSignatureAttribute($value)
    {
        if (null != $value && is_file($value)) {
            isset($this->attributes['client_signature']) ? $this->deleteFile($this->attributes['client_signature'], static::IMAGEPATH) : '';
            $this->attributes['client_signature'] = $this->uploadAllTyps($value, static::IMAGEPATH);
        } elseif (null != $value && $this->isBase64Image($value)) {
            // Handle base64 signature data from mobile apps
            isset($this->attributes['client_signature']) ? $this->deleteFile($this->attributes['client_signature'], static::IMAGEPATH) : '';
            $this->attributes['client_signature'] = $this->uploadBase64Image($value, static::IMAGEPATH);
        }
    }

    /**
     * Check if the value is a base64 encoded image
     */
    private function isBase64Image($value)
    {
        if (strpos($value, 'data:image/') === 0) {
            return true;
        }
        return false;
    }

    /**
     * Upload base64 image data
     */
    private function uploadBase64Image($base64Data, $path)
    {
        // Extract the image data from base64 string
        $imageData = explode(',', $base64Data);
        $imageData = base64_decode($imageData[1]);
        
        // Generate unique filename
        $filename = 'signature_' . time() . '_' . uniqid() . '.png';
        
        // Create directory if it doesn't exist
        $fullPath = public_path('uploads/' . $path);
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
        
        // Save the image
        $filePath = $fullPath . '/' . $filename;
        file_put_contents($filePath, $imageData);
        
        return $filename;
    }

    public static function boot()
    {
        parent::boot();
        
        static::deleted(function ($model) {
            if (isset($model->attributes['driver_license_image'])) {
                $model->deleteFile($model->attributes['driver_license_image'], static::IMAGEPATH);
            }
            if (isset($model->attributes['passport_image'])) {
                $model->deleteFile($model->attributes['passport_image'], static::IMAGEPATH);
            }
            if (isset($model->attributes['client_signature'])) {
                $model->deleteFile($model->attributes['client_signature'], static::IMAGEPATH);
            }
        });
    }
}