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
        for ($i = 1; $i <= 20; $i++) {
            BookingDetail::create([
                'booking_id' => $i,
                'room_id' => rand(1, 10),
                'quantity' => rand(1, 5),
                'price_per_night' => rand(100000, 500000),
                'subtotal_price' => rand(1, 5) * rand(100000, 500000)
            ]);
        }
    }
}
