<?php

namespace Database\Seeders;

use App\Models\BookingDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BookingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            $quantity = rand(1, 5);
            $guests = rand($quantity, $quantity * 2);
            $checkIn = Carbon::now()->addDays(rand(0, 30));
            $duration = rand(1, 5);
            $checkOut = (clone $checkIn)->addDays($duration);
            $pricePerNight = rand(100000, 500000);
            $subtotalPrice = $quantity * $pricePerNight * $duration;

            BookingDetail::create([
                'booking_id'      => $i,
                'room_id'         => rand(1, 10),
                'quantity'        => $quantity,
                'guests'          => $guests,
                'check_in'        => $checkIn->toDateString(),
                'check_out'       => $checkOut->toDateString(),
                'price_per_night' => $pricePerNight,
                'subtotal_price'  => $subtotalPrice,
            ]);
        }
    }
}
