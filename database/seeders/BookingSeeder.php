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
        Booking::create([
            'user_id' => 2,
            'homestay_id' => 1,
            'check_in' => now()->addDays(1),
            'check_out' => now()->addDays(3),
            'base_price' => 600000,
            'service_price' => 60000,
            'total_price' => 660000,
            'status' => 'confirmed',
        ]);
        
    }
}
