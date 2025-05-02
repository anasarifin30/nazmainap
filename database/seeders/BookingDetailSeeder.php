<?php

namespace Database\Seeders;

use App\Models\BookingDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookingDetail::create([
            'booking_id' => 1,
            'room_id' => 1,
            'quantity' => 2,
            'price_per_night' => 200000,
            'subtotal_price' => 400000
        ]);
        
    }
}
