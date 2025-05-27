<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homestay extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function rules()
    {
        return $this->hasMany(Rule::class);
    }

    public function photos()
    {
        return $this->hasMany(HomestayPhoto::class);
    }

    public function coverPhoto()
    {
        return $this->hasOne(HomestayPhoto::class)->where('is_cover', 1);
    }
    
    /** @use HasFactory<\Database\Factories\HomestayFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'address',
        'kodebumdes',
        'status',
        'user_id',
    ];
}
