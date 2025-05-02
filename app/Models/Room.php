<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function bookingDetails()
    {
        return $this->hasMany(BookingDetail::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'room_facility');
    }

    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;
}
