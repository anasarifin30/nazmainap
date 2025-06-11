<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UpdateBookingStatus extends Command
{
    protected $signature = 'booking:update-status';
    protected $description = 'Update booking status automatically based on conditions';

    public function handle()
    {
        $this->info('Starting automatic booking status update...');
        
        $updatedCount = 0;

        // 1. Update expired unpaid bookings
        $expiredBookings = Booking::where('status', 'belum dibayar')
            ->whereHas('transaction', function($query) {
                $query->where('payment_status', 'pending')
                      ->where('expires_at', '<', now());
            })
            ->get();

        foreach ($expiredBookings as $booking) {
            $booking->update(['status' => 'dibatalkan']);
            
            // Update transaction status
            $booking->transaction()->update(['payment_status' => 'expired']);
            
            $updatedCount++;
            Log::info("Booking {$booking->id} expired and cancelled");
        }

        // 2. Update paid bookings from menunggu to aktif when check-in date arrives
        $activeBookings = Booking::where('status', 'menunggu')
            ->where('check_in', '<=', now()->toDateString())
            ->get();

        foreach ($activeBookings as $booking) {
            $booking->update(['status' => 'aktif']);
            $updatedCount++;
            Log::info("Booking {$booking->id} activated on check-in date");
        }

        // 3. Update active bookings to selesai when check-out date passes
        $completedBookings = Booking::where('status', 'aktif')
            ->where('check_out', '<', now()->toDateString())
            ->get();

        foreach ($completedBookings as $booking) {
            $booking->update(['status' => 'selesai']);
            $updatedCount++;
            Log::info("Booking {$booking->id} completed after check-out date");
        }

        // 4. Check for successful payments and update from belum dibayar to menunggu
        $paidBookings = Booking::where('status', 'belum dibayar')
            ->whereHas('transaction', function($query) {
                $query->whereIn('payment_status', ['settlement', 'capture']);
            })
            ->get();

        foreach ($paidBookings as $booking) {
            $booking->update(['status' => 'menunggu']);
            $updatedCount++;
            Log::info("Booking {$booking->id} updated to menunggu after payment");
        }

        $this->info("Updated {$updatedCount} booking statuses");
        Log::info("Automatic booking status update completed. Updated: {$updatedCount} bookings");

        return 0;
    }
}