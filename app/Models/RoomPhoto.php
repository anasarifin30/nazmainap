<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPhoto extends Model
{
    public function room()
    {
        return $this->belongsTo(PhotoCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(PhotoCategory::class);
    }
    
    /** @use HasFactory<\Database\Factories\RoomPhotoFactory> */
    use HasFactory;
}
