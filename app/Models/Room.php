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

    public function photoCategories()
    {
        return $this->hasMany(PhotoCategory::class, 'rooms_id');
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

    public function photos()
    {
        return $this->hasMany(RoomPhoto::class, 'room_id');
    }

    public function roomPhotos() {
        return $this->hasMany(RoomPhoto::class);
    }

    public function roomFacilities() {
        return $this->hasMany(RoomFacility::class);
    }

    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;

    public function getAvailableRoomsCount($checkIn, $checkOut)
    {
        // Get total booked rooms for the given date range
        $bookedRooms = BookingDetail::whereHas('booking', function ($query) use ($checkIn, $checkOut) {
            $query->where(function ($q) use ($checkIn, $checkOut) {
                // Check for overlapping dates
                $q->where(function ($inner) use ($checkIn, $checkOut) {
                    $inner->where('check_in', '<=', $checkOut)
                          ->where('check_out', '>=', $checkIn);
                });
            })->whereIn('status', ['menunggu', 'aktif', 'belum dibayar']);
        })
        ->where('room_id', $this->id)
        ->sum('quantity');

        // Return available rooms
        return max(0, $this->total_rooms - $bookedRooms);
    }
}
