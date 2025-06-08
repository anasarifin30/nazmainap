<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'admin_fee', 'subadmin_fee', 'owner_fee', 'status'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
