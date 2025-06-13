<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'kodebumdes',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function homestayPhotos()
    {
        return $this->hasMany(HomestayPhoto::class);
    }

    public function photos()
    {
        return $this->hasMany(HomestayPhoto::class);
    }

    public function coverPhoto()
    {
        return $this->hasOne(HomestayPhoto::class)->where('is_cover', true);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    // Method untuk mendapatkan semua fasilitas dari rooms
    public function getAllFacilities()
    {
        return $this->rooms()
            ->with('roomFacilities.facility')
            ->get()
            ->pluck('roomFacilities')
            ->flatten()
            ->pluck('facility')
            ->filter()
            ->unique('id');
    }

    // Method untuk mendapatkan fasilitas terpopuler (yang paling banyak ada di room)
    public function getPopularFacilities($limit = 3)
    {
        $facilityCount = [];
        
        foreach($this->rooms as $room) {
            foreach($room->roomFacilities as $roomFacility) {
                if($roomFacility->facility) {
                    $facilityId = $roomFacility->facility->id;
                    $facilityCount[$facilityId] = ($facilityCount[$facilityId] ?? 0) + 1;
                }
            }
        }
        
        // Sort by count descending
        arsort($facilityCount);
        
        // Get facility objects
        $popularFacilityIds = array_slice(array_keys($facilityCount), 0, $limit);
        return Facility::whereIn('id', $popularFacilityIds)->get();
    }
}
