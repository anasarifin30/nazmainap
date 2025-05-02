<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'homestay_id',
        'check_in',
        'check_out',
        'base_price',
        'tax_amount',
        'grand_total',
        'status',
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
        return $this->hasMany(BookingDetail::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
    
    /** @use HasFactory<\Database\Factories\BookingFactory> */
    use HasFactory;
}
