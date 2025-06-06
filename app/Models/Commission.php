<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    
    /** @use HasFactory<\Database\Factories\CommissionFactory> */
    use HasFactory;
}
