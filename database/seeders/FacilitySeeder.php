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
            ['name' => 'TV', 'icon' => 'tv.svg']
        ]);
        
    }
}
