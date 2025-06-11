<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingDetail;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function show(Room $room)
    {
        $checkIn = request('check_in', now()->format('Y-m-d'));
        $checkOut = request('check_out', now()->addDay()->format('Y-m-d'));
        
        // Get existing booking from cart if any
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('status', 'cart')
            ->first();

        // PASTIKAN availableRooms selalu dihitung
        $availableRooms = $room->getAvailableRoomsCount(
            $existingBooking ? $existingBooking->check_in : $checkIn,
            $existingBooking ? $existingBooking->check_out : $checkOut
        );

        $existingDetail = null;
        if ($existingBooking) {
            $existingDetail = $existingBooking->bookingDetails()
                ->where('room_id', $room->id)
                ->whereHas('booking', function($q) use ($existingBooking) {
                    $q->where('check_in', $existingBooking->check_in)
                      ->where('check_out', $existingBooking->check_out);
                })
                ->first();
        }

        $otherRoomsInCart = $existingBooking && $existingBooking->bookingDetails()
            ->where('room_id', '!=', $room->id)
            ->exists();

        // Get related rooms from same homestay, excluding current room
        $relatedRooms = Room::where('homestay_id', $room->homestay_id)
            ->where('id', '!=', $room->id)
            ->with(['photos', 'facilities'])
            ->take(3)
            ->get();

        // LOG untuk debug
        Log::info('Controller - Room Show Data:', [
            'room_id' => $room->id,
            'available_rooms' => $availableRooms,
            'existing_booking' => $existingBooking ? $existingBooking->id : null,
            'existing_detail' => $existingDetail ? $existingDetail->id : null,
            'other_rooms_in_cart' => $otherRoomsInCart
        ]);

        return view('users.detailrooms', compact(
            'room', 
            'availableRooms', 
            'existingBooking',
            'existingDetail',
            'otherRoomsInCart',
            'relatedRooms'
        ));
    }

    private function isProfileComplete($user)
    {
        $missingFields = [];

        // Check basic info
        if (empty($user->name)) $missingFields[] = 'Nama Lengkap';
        if (empty($user->email)) $missingFields[] = 'Email';
        if (empty($user->nomorhp)) $missingFields[] = 'Nomor HP';
        
        // Check profile photo
        if (empty($user->foto)) $missingFields[] = 'Foto Profil';
        
        // Check address fields
        if (empty($user->address)) $missingFields[] = 'Alamat';
        if (empty($user->provinsi)) $missingFields[] = 'Provinsi';
        if (empty($user->kabupaten)) $missingFields[] = 'Kabupaten';
        if (empty($user->kecamatan)) $missingFields[] = 'Kecamatan';
        if (empty($user->kelurahan)) $missingFields[] = 'Kelurahan';

        if (!empty($missingFields)) {
            session()->flash('missing_fields', $missingFields);
            return false;
        }

        return true;
    }

    public function book(Request $request, Room $room)
    {
        $user = Auth::user();
        if (!$this->isProfileComplete($user)) {
            $missingFields = session('missing_fields', []);
            $message = 'Silakan lengkapi data berikut sebelum melakukan pemesanan: ' . implode(', ', $missingFields);
            
            return redirect()->route('users.profile')
                ->with('error', $message)
                ->with('show_required_fields', true);
        }

        DB::beginTransaction(); // HANYA SATU KALI

        try {
            // Validate request
            $request->validate([
                'check_in' => 'required|date|after_or_equal:today',
                'check_out' => 'required|date|after:check_in',
                'quantity' => 'required|integer|min:1|max:5'
            ]);
            
            // Validate check-in and check-out dates
            $checkIn = $request->check_in;
            $checkOut = $request->check_out;
            
            if ($checkIn === $checkOut) {
                DB::rollBack();
                return back()->with('error', 'Tanggal check-in dan check-out tidak boleh sama.');
            }

            // Check room availability
            $availableRooms = $room->getAvailableRoomsCount($checkIn, $checkOut);
            if ($availableRooms < $request->quantity) {
                DB::rollBack();
                return back()->with('error', "Hanya tersedia {$availableRooms} kamar untuk periode yang dipilih.");
            }

            // Check existing booking in cart
            $booking = Booking::where('user_id', Auth::id())
                ->where('status', 'cart')
                ->where('check_in', $checkIn)
                ->where('check_out', $checkOut)
                ->first();

            // If no booking exists, create a new one
            if (!$booking) {
                $booking = Booking::create([
                    'user_id' => Auth::id(),
                    'homestay_id' => $room->homestay_id,
                    'check_in' => $checkIn,
                    'check_out' => $checkOut,
                    'base_price' => 0,
                    'service_price' => 0,
                    'total_price' => 0,
                    'status' => 'cart'
                ]);
                
                Log::info('New booking created:', ['booking_id' => $booking->id]);
            }

            // Check if this room is already in the cart for the same dates
            $existingDetail = BookingDetail::where('booking_id', $booking->id)
                ->where('room_id', $room->id)
                ->first();

            if ($existingDetail) {
                DB::rollBack();
                return back()
                    ->withInput()
                    ->with('error', 'Kamar ini sudah ada di keranjang Anda');
            }

            // Calculate prices
            $nights = $this->calculateNights($checkIn, $checkOut);
            $basePrice = $room->price * $nights;

            // Add booking detail
            $bookingDetail = BookingDetail::create([
                'booking_id' => $booking->id,
                'room_id' => $room->id,
                'quantity' => $request->quantity,
                'price_per_night' => $room->price,
                'subtotal_price' => $basePrice * $request->quantity
            ]);
            
            Log::info('Booking detail created:', ['detail_id' => $bookingDetail->id]);

            // Update total booking price
            $this->updateBookingTotalPrice($booking);

            DB::commit();
            
            Log::info('Booking process completed successfully', [
                'booking_id' => $booking->id,
                'room_id' => $room->id,
                'user_id' => Auth::id()
            ]);
            
            return redirect()->route('users.cart')
                ->with('success', 'Kamar berhasil ditambahkan ke keranjang');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'room_id' => $room->id,
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang: ' . $e->getMessage());
        }
    }

    private function calculateNights($checkIn, $checkOut)
    {
        return ceil((strtotime($checkOut) - strtotime($checkIn)) / (60 * 60 * 24));
    }

    private function updateBookingTotalPrice($booking)
    {
        $totalBasePrice = $booking->bookingDetails->sum('subtotal_price');
        $servicePrice = $totalBasePrice * 0.05;
        
        $booking->update([
            'base_price' => $totalBasePrice,
            'service_price' => $servicePrice,
            'total_price' => $totalBasePrice + $servicePrice
        ]);
    }

    public function checkAvailability(Request $request, Room $room)
    {
        $checkIn = $request->check_in;
        $checkOut = $request->check_out;
        
        Log::info('Check availability API called', [
            'room_id' => $room->id,
            'check_in' => $checkIn,
            'check_out' => $checkOut
        ]);
        
        if (!$checkIn || !$checkOut) {
            return response()->json([
                'error' => 'Check-in and check-out dates are required',
                'available_rooms' => 0
            ], 400);
        }
        
        $availableRooms = $room->getAvailableRoomsCount($checkIn, $checkOut);

        return response()->json([
            'available_rooms' => $availableRooms,
            'total_rooms' => $room->total_rooms,
            'room_name' => $room->name
        ]);
    }
}
