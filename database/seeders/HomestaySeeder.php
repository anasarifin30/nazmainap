<?php

namespace Database\Seeders;

use App\Models\Homestay;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Homestay::create([
            'user_id' => 3,
            'kodebumdes' => 'BDSA001',
            'name' => 'Homestay Mawar',
            'description' => 'Penginapan nyaman di pusat desa.',
            'address' => 'Desa A, Kutowinangun',
            'status' => 'verified',
        ]);
        
    }
}
