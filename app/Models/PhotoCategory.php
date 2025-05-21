<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoCategory extends Model
{
    protected $fillable = [
        'rooms_id',
        'name',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }

    public function roomPhotos()
    {
        return $this->hasMany(RoomPhoto::class, 'category_id');
    }

    public function homestayPhotos()
    {
        return $this->hasMany(HomestayPhoto::class, 'category_id');
    }

    
}
