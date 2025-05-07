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
        $rooms = [];
        for ($i = 1; $i <= 20; $i++) {
            $rooms[] = [
                'homestay_id' => rand(1, 5),
                'name' => 'Kamar ' . chr(64 + $i),
                'description' => 'Deskripsi untuk Kamar ' . chr(64 + $i),
                'price' => rand(100000, 500000),
                'max_guests' => rand(1, 4),
                'total_rooms' => rand(1, 5)
            ];
        }

        Room::insert($rooms);
    }
}
