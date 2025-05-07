<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Facility::insert([
            ['name' => 'WiFi', 'icon' => 'wifi.svg'],
            ['name' => 'AC', 'icon' => 'ac.svg'],
            ['name' => 'TV', 'icon' => 'tv.svg'],
            ['name' => 'Parking', 'icon' => 'parking.svg'],
            ['name' => 'Swimming Pool', 'icon' => 'pool.svg'],
            ['name' => 'Gym', 'icon' => 'gym.svg'],
            ['name' => 'Spa', 'icon' => 'spa.svg'],
            ['name' => 'Restaurant', 'icon' => 'restaurant.svg'],
            ['name' => 'Bar', 'icon' => 'bar.svg'],
            ['name' => 'Laundry', 'icon' => 'laundry.svg'],
            ['name' => 'Room Service', 'icon' => 'room_service.svg'],
            ['name' => 'Conference Room', 'icon' => 'conference.svg'],
            ['name' => 'Playground', 'icon' => 'playground.svg'],
            ['name' => 'Pet Friendly', 'icon' => 'pet_friendly.svg'],
            ['name' => 'Airport Shuttle', 'icon' => 'shuttle.svg'],
            ['name' => '24/7 Reception', 'icon' => 'reception.svg'],
            ['name' => 'Library', 'icon' => 'library.svg'],
            ['name' => 'Garden', 'icon' => 'garden.svg'],
            ['name' => 'Sauna', 'icon' => 'sauna.svg'],
            ['name' => 'Bicycle Rental', 'icon' => 'bicycle.svg']
        ]);
    }
}
