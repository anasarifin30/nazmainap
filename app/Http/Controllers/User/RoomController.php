<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::with(['photos', 'facilities'])->findOrFail($id);
        $existingBooking = null;
        $otherRoomsInCart = null;
        $existingDetail = null; // Initialize the variable

        if (Auth::check()) {
            $existingBooking = Booking::where('user_id', Auth::id())
                ->where('status', 'menunggu')
                ->first();

            if ($existingBooking) {
                // Check if this room is already in cart
                $existingDetail = BookingDetail::where('booking_id', $existingBooking->id)
                    ->where('room_id', $id)
                    ->first();

                // Get other rooms from same homestay that are in cart
                if ($existingBooking->homestay_id === $room->homestay_id) {
                    $otherRoomsInCart = $existingBooking->bookingDetails()
                        ->with('room')
                        ->whereNotIn('room_id', [$id])
                        ->get();
                }
            }
        }

        $relatedRooms = Room::where('homestay_id', $room->homestay_id)
            ->where('id', '!=', $room->id)
            ->with('photos')
            ->take(3)
            ->get();

        return view('users.detailrooms', compact(
            'room', 
            'relatedRooms', 
            'existingBooking', 
            'otherRoomsInCart',
            'existingDetail' // Add this to the compact function
        ));
    }

    public function book(Request $request, Room $room)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan');
        }

        // Check existing booking
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('status', 'menunggu')
            ->first();

        // If there's an existing booking from different homestay
        if ($existingBooking && $existingBooking->homestay_id !== $room->homestay_id) {
            return back()
                ->withInput()
                ->with('error', 'Anda hanya dapat memesan kamar dari homestay yang sama.');
        }

        // If there's an existing booking from same homestay, use its dates
        if ($existingBooking && $existingBooking->homestay_id === $room->homestay_id) {
            $request->merge([
                'check_in' => $existingBooking->check_in,
                'check_out' => $existingBooking->check_out
            ]);
        }

        $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $room->total_rooms
            ]
        ]);

        try {
            // Calculate prices
            $nights = $this->calculateNights($request->check_in, $request->check_out);
            $basePrice = $room->price * $nights;
            
            // Create or get existing booking
            $booking = Booking::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'menunggu'
                ],
                [
                    'homestay_id' => $room->homestay_id,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'base_price' => 0,
                    'service_price' => 0,
                    'total_price' => 0
                ]
            );

            // Check if room is already in cart
            $existingDetail = BookingDetail::where('booking_id', $booking->id)
                ->where('room_id', $room->id)
                ->first();

            if ($existingDetail) {
                return back()
                    ->withInput()
                    ->with('error', 'Kamar ini sudah ada di keranjang Anda');
            }

            // Add booking detail
            BookingDetail::create([
                'booking_id' => $booking->id,
                'room_id' => $room->id,
                'quantity' => $request->quantity,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'price_per_night' => $room->price,
                'subtotal_price' => $basePrice * $request->quantity
            ]);

            // Update total booking price
            $this->updateBookingTotalPrice($booking);

            return redirect()->route('users.cart')
                ->with('success', 'Kamar berhasil ditambahkan ke keranjang');

        } catch (\Exception $e) {
            Log::error('Booking error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang.');
        }
    }

    public function checkAvailability(Request $request, Room $room)
    {
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;

        $existingBooking = Booking::where('room_id', $room->id)
            ->where(function($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut]);
            })->exists();

        return response()->json([
            'available' => !$existingBooking
        ]);
    }

    private function calculateNights($checkIn, $checkOut)
    {
        return ceil((strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24));
    }

    private function updateBookingTotalPrice($booking)
    {
        $totalBasePrice = $booking->bookingDetails->sum('subtotal_price');
        $totalServicePrice = $totalBasePrice * 0.05;
        
        $booking->update([
            'base_price' => $totalBasePrice,
            'service_price' => $totalServicePrice,
            'total_price' => $totalBasePrice + $totalServicePrice
        ]);
    }
}
