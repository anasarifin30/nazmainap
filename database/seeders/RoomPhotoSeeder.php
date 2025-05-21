<?php

namespace Database\Seeders;

use App\Models\RoomPhoto;
use Illuminate\Database\Seeder;

class RoomPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoomPhoto::create([
            'room_id' => 1,
            'category_id' => 1,
            'photo_path' => 'room1.jpg',
            'is_cover' => true,
        ]);

        RoomPhoto::create([
            'room_id' => 1,
            'category_id' => 2,
            'photo_path' => 'room1.jpg',
            'is_cover' => false,
        ]);

        RoomPhoto::create([
            'room_id' => 2,
            'category_id' => 3,
            'photo_path' => 'room1.jpg',
            'is_cover' => false,
        ]);

        RoomPhoto::create([
            'room_id' => 2,
            'category_id' => 4,
            'photo_path' => 'room1.jpg',
            'is_cover' => false,
        ]);

        RoomPhoto::create([
            'room_id' => 3,
            'category_id' => 5,
            'photo_path' => 'room2.jpg',
            'is_cover' => false,
        ]);

        RoomPhoto::create([
            'room_id' => 3,
            'category_id' => 6,
            'photo_path' => 'room2.jpg',
            'is_cover' => false,
        ]);
    }
}
