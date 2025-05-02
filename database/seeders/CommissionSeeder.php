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
        Commission::create([
            'transaction_id' => 1,
            'admin_fee' => 10000,
            'subadmin_fee' => 15000,
            'owner_fee' => 50000,
            'status' => 'unpaid'
        ]);
        
    }
}
