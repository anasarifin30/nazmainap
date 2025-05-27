<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    /** @use HasFactory<\Database\Factories\RoomFacilityFactory> */
    use HasFactory;

    protected $table = 'room_facility';

    public function facility() {
        return $this->belongsTo(Facility::class);
    }
}
