<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;

class CleanupExpiredTransactions extends Command
{
    protected $signature = 'transactions:cleanup';
    protected $description = 'Clean up expired transactions';

    public function handle()
    {
        Transaction::where('payment_status', 'pending')
            ->whereRaw('created_at < NOW() - INTERVAL 10 MINUTE')
            ->delete();

        $this->info('Expired transactions cleaned up successfully');
    }
}