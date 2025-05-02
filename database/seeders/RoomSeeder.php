<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::insert([
            [
                'homestay_id' => 1,
                'name' => 'Kamar A',
                'description' => 'Kamar dengan AC dan kamar mandi dalam',
                'price' => 200000,
                'max_guests' => 2,
                'total_rooms' => 3
            ],
            [
                'homestay_id' => 1,
                'name' => 'Kamar B',
                'description' => 'Kamar ekonomis dengan kipas angin',
                'price' => 150000,
                'max_guests' => 2,
                'total_rooms' => 2
            ]
        ]);
        
    }
}
