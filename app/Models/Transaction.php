<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
    
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;
}
