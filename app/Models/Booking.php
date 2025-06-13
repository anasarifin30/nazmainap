<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'homestay_id', 
        'check_in',
        'check_out',
        'base_price',
        'service_price', 
        'total_price',
        'status',
        'payment_deadline',
    ];

    // Remove the attributes that don't exist in database
    protected $attributes = [
        'base_price' => 0,
        'service_price' => 0,
        'total_price' => 0,
        'status' => 'cart'  // Tambahkan default status
    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
        'base_price' => 'decimal:2',
        'service_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'payment_deadline' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function bookingDetails()
    {
        return $this->hasMany(\App\Models\BookingDetail::class, 'booking_id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;

    public function getTotalNights()
    {
        return Carbon::parse($this->check_in)->diffInDays(Carbon::parse($this->check_out));
    }

    // Get duration in days
    public function getDurationAttribute()
    {
        return $this->check_in->diffInDays($this->check_out);
    }
}
