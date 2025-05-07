<?php

namespace Database\Seeders;

use App\Models\RoomPhoto;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomPhotos = [];
        for ($i = 1; $i <= 20; $i++) {
            $roomPhotos[] = [
                'room_id' => $i,
                'photo_url' => "https://example.com/photos/room{$i}_cover.jpg",
                'is_cover' => true,
            ];
            $roomPhotos[] = [
                'room_id' => $i,
                'photo_url' => "https://example.com/photos/room{$i}_extra.jpg",
                'is_cover' => false,
            ];
        }

        RoomPhoto::insert($roomPhotos);
    }
}
