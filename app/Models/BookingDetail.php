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
        'subtotal_price'
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'subtotal_price' => 'decimal:2',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class, 'room_id');
    }
    public function getTotalNights()
    {
        return ceil(
            (strtotime($this->booking->check_out) - strtotime($this->booking->check_in)) / (60 * 60 * 24)
        );
    }
}
