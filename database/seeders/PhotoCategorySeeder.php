<?php

namespace Database\Seeders;

use App\Models\PhotoCategory;
use Illuminate\Database\Seeder;

class PhotoCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Kamar Tidur',
            'Kamar Mandi',
            'Ruang Tamu',
            'Dapur',
            'Teras',
            'Halaman',
        ];

        foreach ($categories as $name) {
            PhotoCategory::create(['name' => $name]);
        }
    }
}
