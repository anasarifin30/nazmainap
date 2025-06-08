<?php

namespace App\Http\Controllers\User;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Models\BookingDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap; // Import Midtrans Snap
use App\Models\Transaction as Transaction; // Pastikan alias ini benar

class CartController extends Controller
{
    public function index()
    {
        $booking = Booking::where('user_id', Auth::id())
            ->where('status', 'cart')
            ->with([
                'homestay',
                'homestay.coverPhoto',
                'bookingDetails',
                'bookingDetails.room',
                'bookingDetails.room.roomPhotos'
            ])
            ->latest()
            ->first();

        // Debug untuk memeriksa data
        Log::info('Cart Data:', [
            'user_id' => Auth::id(),
            'booking' => $booking ? $booking->toArray() : null
        ]);

        return view('users.cart', compact('booking'));
    }

    public function update(Request $request, BookingDetail $bookingDetail)
    {
        try {
            $room = $bookingDetail->room;
            $booking = $bookingDetail->booking;

            // Check room availability for the period
            // This method should correctly handle check-in on the same day as checkout
            $availableRooms = $room->getAvailableRoomsCount($booking->check_in, $booking->check_out);
            $currentQuantity = $bookingDetail->quantity;
            $action = $request->input('action');
            $newQuantity = $action === 'increment' ? $currentQuantity + 1 : $currentQuantity - 1;

            // Validate if enough rooms are available
            if ($action === 'increment' && $newQuantity > $availableRooms) {
                return response()->json([
                    'success' => false,
                    'message' => "Hanya tersedia {$availableRooms} kamar untuk periode yang dipilih."
                ]);
            }

            // Validate quantity limits
            if ($newQuantity < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jumlah kamar minimal adalah 1.'
                ]);
            }

            // Update booking detail
            $bookingDetail->update([
                'quantity' => $newQuantity,
                'subtotal_price' => $room->price * $newQuantity * $this->calculateNights($booking->check_in, $booking->check_out)
            ]);

            // Update booking totals
            $this->updateBookingTotals($booking);

            return response()->json([
                'success' => true,
                'quantity' => $newQuantity,
                'subtotal_price' => $bookingDetail->subtotal_price,
                'total_base_price' => $booking->base_price,
                'service_price' => $booking->service_price,
                'total_price' => $booking->total_price,
                'max_rooms' => $availableRooms // Return max available rooms
            ]);

        } catch (\Exception $e) {
            Log::error('Cart update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui keranjang.'
            ]);
        }
    }

    private function calculateNights($checkIn, $checkOut)
    {
        return ceil((strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24));
    }

    private function updateBookingTotals($booking)
    {
        $totalBasePrice = $booking->bookingDetails->sum('subtotal_price');
        $servicePrice = $totalBasePrice * 0.05;

        $booking->update([
            'base_price' => $totalBasePrice,
            'service_price' => $servicePrice,
            'total_price' => $totalBasePrice + $servicePrice
        ]);
    }

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $booking = Booking::where('user_id', Auth::id())
                ->where('status', 'cart')
                ->firstOrFail();

            // Validasi booking
            if ($booking->bookingDetails->isEmpty()) {
                throw new \Exception('Keranjang kosong');
            }

            // Create new transaction
            $orderId = 'BOOK-'.$booking->id.'-'.time();
            $expiryTime = now()->addMinutes(10);

            // Midtrans configuration
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $booking->total_price,
                ],
                'customer_details' => [
                    'first_name' => $booking->user->name,
                    'email' => $booking->user->email,
                    'phone' => $booking->user->nomorhp,
                ],
                'expiry' => [
                    'unit' => 'minutes',
                    'duration' => 10,
                ],
                'enabled_payments' => [
                    'credit_card', 'bca_va', 'bni_va', 'bri_va',
                    'mandiri_clickpay', 'gopay', 'shopeepay'
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Create transaction record
            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_status' => 'pending',
                'midtrans_order_id' => $orderId,
                'snap_token' => $snapToken,
                'expires_at' => $expiryTime
            ]);

            $remainingSeconds = now()->diffInSeconds($transaction->expires_at);

            // Update booking status
            $booking->update(['status' => 'belum dibayar']);

            DB::commit();

            // Return untuk AJAX request
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'snap_token' => $snapToken
                ]);
            }

            // Regular form submit - redirect dengan snap token
            return redirect()->route('users.detailbooking', $booking->id)
                ->with([
                    'snap_token' => $snapToken,
                    'remaining_seconds' => $remainingSeconds // dari diffInSeconds(expires_at)
                ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()->with('error', $e->getMessage());
        }
    }
}
