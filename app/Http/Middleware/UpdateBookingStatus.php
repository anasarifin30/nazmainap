<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class UpdateBookingStatus
{
    public function handle(Request $request, Closure $next)
    {
        // Auto update status untuk user yang sedang login
        if (Auth::check()) {
            $this->updateUserBookingStatuses();
        }

        return $next($request);
    }

    private function updateUserBookingStatuses()
    {
        $userId = Auth::id();
        $now = now();

        // Update expired bookings
        Booking::where('user_id', $userId)
            ->where('status', 'belum dibayar')
            ->whereHas('transaction', function($query) use ($now) {
                $query->where('payment_status', 'pending')
                      ->where('expires_at', '<', $now);
            })
            ->update(['status' => 'dibatalkan']);

        // Update paid bookings
        Booking::where('user_id', $userId)
            ->where('status', 'belum dibayar')
            ->whereHas('transaction', function($query) {
                $query->whereIn('payment_status', ['settlement', 'capture']);
            })
            ->update(['status' => 'menunggu']);

        // Update to active
        Booking::where('user_id', $userId)
            ->where('status', 'menunggu')
            ->where('check_in', '<=', $now->toDateString())
            ->update(['status' => 'aktif']);

        // Update to completed
        Booking::where('user_id', $userId)
            ->where('status', 'aktif')
            ->where('check_out', '<', $now->toDateString())
            ->update(['status' => 'selesai']);
    }
}