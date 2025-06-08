<?php
namespace App\Http\Controllers\User;

use App\Models\Transaction;
use App\Models\Commission;

class CommisionController
{
    public function createCommission(Transaction $transaction)
    {
        $total = $transaction->amount;

        $ownerFee = round($total * 0.75, 2);
        $subadminFee = round($total * 0.10, 2);
        $adminFee = round($total * 0.15, 2);

        // Simpan ke tabel commissions
        Commission::create([
            'transaction_id' => $transaction->id,
            'admin_fee' => $adminFee,
            'subadmin_fee' => $subadminFee,
            'owner_fee' => $ownerFee,
            'status' => 'unpaid'
        ]);
    }
}