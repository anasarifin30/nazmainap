<?php

namespace Database\Seeders;

use App\Models\Homestay;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
{
    $this->call([
        UserSeeder::class,
        HomestaySeeder::class,
        RoomSeeder::class,
        PhotoCategorySeeder::class,
        HomestayPhotoSeeder::class,
        RoomPhotoSeeder::class,
        FacilitySeeder::class,
        RoomFacilitySeeder::class,
        RuleSeeder::class,
        BookingSeeder::class,
        BookingDetailSeeder::class,
        TransactionSeeder::class,
        CommissionSeeder::class,
    ]);
}

}
