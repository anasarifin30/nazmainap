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
        for ($i = 1; $i <= 20; $i++) {
            Transaction::create([
                'booking_id' => $i,
                'amount' => 660000 + ($i * 1000),
                'payment_status' => $i % 2 === 0 ? 'paid' : 'pending',
                'payment_method' => $i % 3 === 0 ? 'midtrans' : 'paypal',
                'midtrans_order_id' => 'INV20250430-' . str_pad($i, 4, '0', STR_PAD_LEFT)
            ]);
        }
    }
}
