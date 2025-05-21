<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomestayPhotoSeeder extends Seeder
{
    public function run()
    {
        $photos = [
            [
                'homestay_id' => 1,
                'category_id' => 1, // ganti sesuai id kategori eksterior
                'photo_path' => 'homestay1.jpg',
                'is_cover' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'homestay_id' => 1,
                'category_id' => 2, // ganti sesuai id kategori interior
                'photo_path' => 'homestay1.jpg',
                'is_cover' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'homestay_id' => 2,
                'category_id' => 3, // ganti sesuai id kategori fasilitas
                'photo_path' => 'homestay1.jpg',
                'is_cover' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'homestay_id' => 2,
                'category_id' => 4, // ganti sesuai id kategori lingkungan
                'photo_path' => 'homestay1.jpg',
                'is_cover' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('homestay_photos')->insert($photos);
    }
}