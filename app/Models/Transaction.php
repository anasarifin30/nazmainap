<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'payment_status',
        'midtrans_order_id',
        'snap_token',
        'expires_at', // Pastikan ini ada di fillable jika menggunakan mass assignment
        'payment_method', // Tambahkan jika ada
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'expires_at' => 'datetime', // Tambahkan baris ini
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }


    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
}
