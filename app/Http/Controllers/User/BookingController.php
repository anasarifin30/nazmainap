<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Transaction as Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Midtrans\Snap;

class BookingController extends Controller
{
    public function pay(Request $request, Booking $booking)
    {
        try {
            // Check for existing transaction
            $existingTransaction = Transaction::where('booking_id', $booking->id)
                ->where('payment_status', 'pending')
                ->where('expires_at', '>', now())
                ->first();

            if ($existingTransaction) {
                $remainingSeconds = now()->diffInSeconds($existingTransaction->expires_at);
                
                return response()->json([
                    'status' => 'success',
                    'snap_token' => $existingTransaction->snap_token,
                    'order_id' => $existingTransaction->midtrans_order_id,
                    'remaining_seconds' => $remainingSeconds
                ]);
            }

            DB::beginTransaction();

            // Generate unique order ID
            $orderId = 'BOOK-'.$booking->id.'-'.time();
            
            // Calculate expiry time
            $expiryTime = now()->addMinutes(10);

            // Set Midtrans configuration
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

            // Get Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            
            // Create new transaction
            $transaction = Transaction::create([
                'booking_id' => $booking->id,
                'amount' => $booking->total_price,
                'payment_status' => 'pending',
                'midtrans_order_id' => $orderId,
                'snap_token' => $snapToken,
                'expires_at' => $expiryTime
            ]);

            Log::info('Transaction created', [
                'transaction_id' => $transaction->id,
                'expires_at' => $transaction->expires_at,
                'now' => now(),
                'expiry_time' => $expiryTime
            ]);

            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'remaining_seconds' => 600 // 10 minutes in seconds
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Error: ' . $e->getMessage());
            
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memproses pembayaran'
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        try {
            $notification = new \Midtrans\Notification();
            
            $transaction = Transaction::where('midtrans_order_id', $notification->order_id)->first();
            
            if ($transaction) {
                $transaction->payment_status = $notification->transaction_status;
                $transaction->payment_method = $notification->payment_type;
                $transaction->save();

                // Update booking status
                if (in_array($notification->transaction_status, ['capture', 'settlement'])) {
                    $transaction->booking->update(['status' => 'menunggu']);
                } elseif (in_array($notification->transaction_status, ['deny', 'cancel', 'expire'])) {
                    $transaction->booking->update(['status' => 'dibatalkan']);
                }
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function cancel(Booking $booking)
    {
        try {
            if ($booking->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            DB::beginTransaction();

            // Check if booking is still in 'belum dibayar' status
            if ($booking->status === 'belum dibayar') {
                $booking->status = 'dibatalkan';
                $booking->save();

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Booking cancelled successfully'
                ]);
            }

            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Invalid booking status'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking cancellation error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error cancelling booking'
            ], 500);
        }
    }
    public function updateStatus(Request $request, Booking $booking)
    {
        try {
            if ($booking->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action'
                ], 403);
            }

            DB::beginTransaction();

            // Update booking status
            $booking->status = 'menunggu';
            $booking->save();

            // Update transaction record
            $transaction = Transaction::where('booking_id', $booking->id)
                ->latest()
                ->first();

            if ($transaction) {
                $transaction->payment_status = 'settlement';
                $transaction->payment_method = $request->payment_method; // Add this line
                $transaction->save();
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Status update error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error updating status'
            ], 500);
        }
    }
}