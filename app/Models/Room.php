<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'homestay_id',
        'name',
        'description',
        'price',
        'max_guests',
        'total_rooms'
    ];

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

    public function getAvailableRoomsCount($checkIn, $checkOut)
    {
        // Debug: Log input parameters
        Log::info('=== CHECKING ROOM AVAILABILITY ===', [
            'room_id' => $this->id,
            'room_name' => $this->name,
            'check_in' => $checkIn,
            'check_out' => $checkOut,
            'total_rooms' => $this->total_rooms
        ]);

        // Status yang aktif (booking yang masih berlaku)
        $activeStatuses = ['belum dibayar', 'menunggu', 'aktif'];

        // Pastikan kelas BookingDetail digunakan dengan namespace penuh
        $bookedRoomsQuery = \App\Models\BookingDetail::whereHas('booking', function ($query) use ($checkIn, $checkOut, $activeStatuses) {
            $query->where(function ($q) use ($checkIn, $checkOut) {
                // Check overlapping dates:
                // Overlap jika: new_check_in < existing_check_out AND new_check_out > existing_check_in
                $q->where('check_in', '<', $checkOut)
                  ->where('check_out', '>', $checkIn);
            })
            ->whereIn('status', $activeStatuses);
        })
        ->where('room_id', $this->id);

        // Get detailed information
        $overlappingBookings = $bookedRoomsQuery->with('booking')->get();
        $bookedRooms = $overlappingBookings->sum('quantity');

        Log::info('=== BOOKING DETAILS ===', [
            'room_id' => $this->id,
            'overlapping_bookings_count' => $overlappingBookings->count(),
            'overlapping_details' => $overlappingBookings->map(function($bd) {
                return [
                    'booking_id' => $bd->booking_id,
                    'quantity' => $bd->quantity,
                    'status' => $bd->booking->status,
                    'check_in' => $bd->booking->check_in,
                    'check_out' => $bd->booking->check_out,
                ];
            })->toArray(),
            'total_booked_rooms' => $bookedRooms
        ]);

        $availableRooms = max(0, $this->total_rooms - $bookedRooms);

        Log::info('=== FINAL CALCULATION ===', [
            'room_id' => $this->id,
            'total_rooms' => $this->total_rooms,
            'booked_rooms' => $bookedRooms,
            'available_rooms' => $availableRooms,
            'formula' => "{$this->total_rooms} - {$bookedRooms} = {$availableRooms}"
        ]);

        return $availableRooms;
    }
}
