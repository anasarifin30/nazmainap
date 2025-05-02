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
        RoomPhoto::insert([
            [
                'room_id' => 1,
                'photo_url' => '',
                'is_cover' => true,
            ],
            [
                'room_id' => 1,
                'photo_url' => '',
                'is_cover' => false,
            ],
        ]);
        
    }
}
