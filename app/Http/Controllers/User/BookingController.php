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
use App\Models\Commission;

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
            
            // Calculate expiry time - change to 10 minutes
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
                    'unit' => 'minutes',  // change to minutes
                    'duration' => 10,     // change to 10
                ],
                'enabled_payments' => [
                    'credit_card', 'bca_va', 'bni_va', 'bri_va', 
                    'mandiri_clickpay', 'gopay', 'shopeepay'
                ],
                'finish_redirect_url' => [
                    'finish' => route('users.detailbooking', $booking->id),
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

            // Calculate remaining seconds for the new transaction
            $remainingSeconds = now()->diffInSeconds($expiryTime);

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
                // ...tambahan lain jika perlu
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
                // Update transaction status
                $transaction->update([
                    'payment_status' => $notification->transaction_status,
                    'payment_method' => $notification->payment_type ?? null
                ]);

                // Auto update booking status based on payment
                $booking = $transaction->booking;
                
                if (in_array($notification->transaction_status, ['capture', 'settlement'])) {
                    $booking->update(['status' => 'menunggu']);
                    $this->createCommission($transaction);
                    
                    Log::info("Payment successful for booking {$booking->id}, status updated to menunggu");
                    
                } elseif (in_array($notification->transaction_status, ['deny', 'cancel', 'expire', 'failure'])) {
                    $booking->update(['status' => 'dibatalkan']);
                    
                    Log::info("Payment failed for booking {$booking->id}, status updated to dibatalkan");
                }
            }

            return response()->json(['status' => 'success']);
            
        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function cancel(Request $request, Booking $booking)
    {
        try {
            DB::beginTransaction();

            // Check if booking belongs to user
            if (!$booking || $booking->user_id !== Auth::id()) {
                throw new \Exception('Pemesanan tidak ditemukan atau tidak valid');
            }

            // Find the pending transaction
            $transaction = Transaction::where('booking_id', $booking->id)
                ->whereIn('payment_status', ['pending'])
                ->first();

            if (!$transaction) {
                throw new \Exception('Transaksi tidak ditemukan');
            }

            // Update booking status
            $booking->update([
                'status' => 'dibatalkan',
                'payment_deadline' => null
            ]);

            // Update transaction status
            $transaction->update([
                'payment_status' => 'expire',
                'expires_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Pemesanan berhasil dibatalkan',
                'redirect' => route('users.historycart')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Cancel booking error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'user_id' => Auth::id()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membatalkan pemesanan'
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

            // Check if payment has expired
            $transaction = Transaction::where('booking_id', $booking->id)
                ->latest()
                ->first();

            if ($transaction && $transaction->expires_at < now()) {
                // Update booking status
                $booking->status = 'dibatalkan';
                $booking->save();

                // Update transaction status
                $transaction->payment_status = 'expired';
                $transaction->save();

                DB::commit();

                // Return expired status
                return response()->json([
                    'success' => false,
                    'expired' => true,
                    'message' => 'Waktu pembayaran telah habis',
                    'redirect' => route('users.historycart')
                ]);
            }

            // If payment is successful
            if ($request->payment_status === 'settlement') {
                $booking->status = 'menunggu';
                $booking->save();

                $transaction->payment_status = 'settlement';
                $transaction->payment_method = $request->payment_method;
                $transaction->save();

                $this->createCommission($transaction);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diperbarui',
                'redirect' => route('users.historycart')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Status update error: ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status'
            ], 500);
        }
    }
    
    public function createCommission(Transaction $transaction)
    {
        $total = $transaction->amount;

        $ownerFee = round($total * 0.75, 2);
        $subadminFee = round($total * 0.10, 2);
        $adminFee = round($total * 0.15, 2);

        Commission::create([
            'transaction_id' => $transaction->id,
            'admin_fee' => $adminFee,
            'subadmin_fee' => $subadminFee,
            'owner_fee' => $ownerFee,
            'status' => 'unpaid'
        ]);
    }
}