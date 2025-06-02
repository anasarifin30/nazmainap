<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\BookingDetail;
use App\Models\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

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
            
            // Check for checkout conflicts
            $existingCheckout = Booking::where('homestay_id', $booking->homestay_id)
                ->where('id', '!=', $booking->id)
                ->whereIn('status', ['menunggu', 'aktif', 'belum dibayar'])
                ->whereDate('check_out', $booking->check_in)
                ->exists();

            if ($existingCheckout) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menambah kamar karena ada checkout di tanggal check-in yang dipilih.'
                ]);
            }

            // Check room availability for the period
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
                'max_rooms' => $availableRooms
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
        $booking = Booking::where('user_id', Auth::id())
            ->where('status', 'cart')
            ->firstOrFail();

        try {
            DB::beginTransaction();
            
            // Set payment deadline to exactly 10 minutes from now
            $booking->payment_deadline = now()->addMinutes(10);
            $booking->status = 'belum dibayar';
            $booking->save();

            DB::commit();
            
            return redirect()->route('users.detailbooking', $booking->id)
                ->with('success', 'Silahkan selesaikan pembayaran dalam 10 menit');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat checkout.');
        }
    }
}