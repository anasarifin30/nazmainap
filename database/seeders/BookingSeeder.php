<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Booking::create([
                'user_id' => rand(1, 10),
                'homestay_id' => rand(1, 5),
                'check_in' => now()->addDays(rand(1, 10)),
                'check_out' => now()->addDays(rand(11, 20)),
                'base_price' => rand(500000, 1000000),
                'service_price' => rand(50000, 100000),
                'total_price' => rand(500000, 1000000) + rand(50000, 100000),
                'status' => 'aktif',
            ]);
        }
    }
}
