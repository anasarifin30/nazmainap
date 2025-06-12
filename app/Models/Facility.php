<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon'
    ];

    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_facility', 'facility_id', 'room_id');
    }
}
