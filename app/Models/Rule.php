<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    public function homestay()
    {
        return $this->belongsTo(Homestay::class);
    }
    
    /** @use HasFactory<\Database\Factories\RuleFactory> */
    use HasFactory;
}
