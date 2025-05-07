<?php

namespace Database\Seeders;

use App\Models\Commission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {
            Commission::create([
                'transaction_id' => $i,
                'admin_fee' => rand(5000, 20000),
                'subadmin_fee' => rand(10000, 30000),
                'owner_fee' => rand(40000, 60000),
                'status' => 'unpaid'
            ]);
        }
    }
}
