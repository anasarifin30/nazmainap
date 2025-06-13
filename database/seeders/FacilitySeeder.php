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
        $facilities = [
            // Basic Facilities
            [
                'name' => 'WiFi Gratis',
                'icon' => 'fas fa-wifi',
                'category' => 'basic',
                'sort_order' => 1
            ],
            [
                'name' => 'Parkir Gratis',
                'icon' => 'fas fa-parking',
                'category' => 'basic',
                'sort_order' => 2
            ],
            [
                'name' => 'AC',
                'icon' => 'fas fa-snowflake',
                'category' => 'basic',
                'sort_order' => 3
            ],
            [
                'name' => 'Dapur Bersama',
                'icon' => 'fas fa-utensils',
                'category' => 'basic',
                'sort_order' => 4
            ],
            [
                'name' => 'Kulkas',
                'icon' => 'fas fa-temperature-low',
                'category' => 'basic',
                'sort_order' => 5
            ],
            [
                'name' => 'Televisi',
                'icon' => 'fas fa-tv',
                'category' => 'basic',
                'sort_order' => 6
            ],
            [
                'name' => 'Mesin Cuci',
                'icon' => 'fas fa-tshirt',
                'category' => 'basic',
                'sort_order' => 7
            ],

            // Entertainment Facilities
            [
                'name' => 'Karaoke',
                'icon' => 'fas fa-microphone',
                'category' => 'entertainment',
                'sort_order' => 8
            ],
            [
                'name' => 'Billiard',
                'icon' => 'fas fa-circle',
                'category' => 'entertainment',
                'sort_order' => 9
            ],
            [
                'name' => 'PlayStation',
                'icon' => 'fas fa-gamepad',
                'category' => 'entertainment',
                'sort_order' => 10
            ],
            [
                'name' => 'Ruang Keluarga',
                'icon' => 'fas fa-couch',
                'category' => 'entertainment',
                'sort_order' => 11
            ],
            [
                'name' => 'Netflix/TV Cable',
                'icon' => 'fas fa-film',
                'category' => 'entertainment',
                'sort_order' => 12
            ],

            // Outdoor Facilities
            [
                'name' => 'Kolam Renang',
                'icon' => 'fas fa-swimming-pool',
                'category' => 'outdoor',
                'sort_order' => 13
            ],
            [
                'name' => 'Taman',
                'icon' => 'fas fa-tree',
                'category' => 'outdoor',
                'sort_order' => 14
            ],
            [
                'name' => 'BBQ Area',
                'icon' => 'fas fa-fire',
                'category' => 'outdoor',
                'sort_order' => 15
            ],
            [
                'name' => 'Gazebo',
                'icon' => 'fas fa-umbrella',
                'category' => 'outdoor',
                'sort_order' => 16
            ],
            [
                'name' => 'Balkon/Teras',
                'icon' => 'fas fa-mountain',
                'category' => 'outdoor',
                'sort_order' => 17
            ],

            // Business Facilities
            [
                'name' => 'Ruang Meeting',
                'icon' => 'fas fa-users',
                'category' => 'business',
                'sort_order' => 18
            ],
            [
                'name' => 'Printer/Scanner',
                'icon' => 'fas fa-print',
                'category' => 'business',
                'sort_order' => 19
            ],
            [
                'name' => 'Proyektor',
                'icon' => 'fas fa-video',
                'category' => 'business',
                'sort_order' => 20
            ],

            // General Facilities
            [
                'name' => '24 Jam Security',
                'icon' => 'fas fa-shield-alt',
                'category' => 'general',
                'sort_order' => 21
            ],
            [
                'name' => 'CCTV',
                'icon' => 'fas fa-camera',
                'category' => 'general',
                'sort_order' => 22
            ],
            [
                'name' => 'Laundry Service',
                'icon' => 'fas fa-hands-wash',
                'category' => 'general',
                'sort_order' => 23
            ],
            [
                'name' => 'Room Service',
                'icon' => 'fas fa-bell-concierge',
                'category' => 'general',
                'sort_order' => 24
            ],
            [
                'name' => 'Sarapan',
                'icon' => 'fas fa-coffee',
                'category' => 'general',
                'sort_order' => 25
            ],
            [
                'name' => 'Mini Market',
                'icon' => 'fas fa-store',
                'category' => 'general',
                'sort_order' => 26
            ],
            [
                'name' => 'Lift/Elevator',
                'icon' => 'fas fa-arrows-alt-v',
                'category' => 'general',
                'sort_order' => 27
            ],
            [
                'name' => 'Akses Disable',
                'icon' => 'fas fa-wheelchair',
                'category' => 'general',
                'sort_order' => 28
            ]
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
