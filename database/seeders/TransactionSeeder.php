<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'booking_id' => 1,
            'amount' => 660000,
            'payment_status' => 'paid',
            'payment_method' => 'midtrans',
            'midtrans_order_id' => 'INV20250430-0001'
        ]);
        
    }
}
