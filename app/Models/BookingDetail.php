<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    /** @use HasFactory<\Database\Factories\BookingDetailFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'room_id',
        'quantity',
        'price_per_night',
        'subtotal_price',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
