<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'room_facility');
    }
    
    /** @use HasFactory<\Database\Factories\FacilityFactory> */
    use HasFactory;
}
