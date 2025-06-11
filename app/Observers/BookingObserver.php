<?php

namespace App\Observers;

use App\Models\Booking;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    public function updating(Booking $booking)
    {
        // Auto update status ketika booking diakses
        $this->autoUpdateStatus($booking);
    }

    public function retrieved(Booking $booking)
    {
        // Auto update status ketika booking diambil dari database
        $this->autoUpdateStatus($booking);
    }

    private function autoUpdateStatus(Booking $booking)
    {
        $originalStatus = $booking->status;
        $newStatus = $this->determineStatus($booking);

        if ($originalStatus !== $newStatus) {
            $booking->status = $newStatus;
            
            // Jika menggunakan retrieved event, hindari infinite loop
            if (!$booking->isDirty()) {
                $booking->save();
            }
            
            Log::info("Auto updated booking {$booking->id} status from {$originalStatus} to {$newStatus}");
        }
    }

    private function determineStatus(Booking $booking)
    {
        $now = now();
        $checkIn = Carbon::parse($booking->check_in);
        $checkOut = Carbon::parse($booking->check_out);

        // Skip jika sudah dibatalkan atau selesai
        if (in_array($booking->status, ['dibatalkan', 'selesai'])) {
            return $booking->status;
        }

        // Cek transaction untuk status pembayaran
        $transaction = $booking->transaction;

        // Jika belum dibayar
        if ($booking->status === 'belum dibayar') {
            if ($transaction) {
                // Cek apakah payment expired
                if ($transaction->expires_at && $transaction->expires_at < $now) {
                    return 'dibatalkan';
                }
                
                // Cek apakah sudah dibayar
                if (in_array($transaction->payment_status, ['settlement', 'capture'])) {
                    return 'menunggu';
                }
            }
            
            return 'belum dibayar';
        }

        // Jika menunggu, cek apakah sudah waktunya check-in
        if ($booking->status === 'menunggu') {
            if ($checkIn->lte($now->toDateString())) {
                return 'aktif';
            }
            return 'menunggu';
        }

        // Jika aktif, cek apakah sudah melewati check-out
        if ($booking->status === 'aktif') {
            if ($checkOut->lt($now->toDateString())) {
                return 'selesai';
            }
            return 'aktif';
        }

        return $booking->status;
    }
}