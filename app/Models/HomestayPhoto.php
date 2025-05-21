<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomestayPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'homestay_id',
        'photo_path',
        'category',
        'is_cover',
    ];

    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }

    public function category()
    {
        return $this->belongsTo(PhotoCategory::class, 'category_id');
    }
}