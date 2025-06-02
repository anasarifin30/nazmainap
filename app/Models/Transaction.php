<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_status',
        'payment_method', // Make sure this is included
        'midtrans_order_id',
        'snap_token',
        'expires_at'
    ];

    protected $dates = [
        'expires_at'  // Add this line to cast the field to datetime
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
}
