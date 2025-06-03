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

        $availableRooms = $room->getAvailableRoomsCount(
            $existingBooking ? $existingBooking->check_in : $checkIn,
            $existingBooking ? $existingBooking->check_out : $checkOut
        );

        $existingDetail = null;
        if ($existingBooking) {
            $existingDetail = $existingBooking->bookingDetails()
                ->where('room_id', $room->id)
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

        return view('users.detailrooms', compact(
            'room', 
            'availableRooms',
            'existingBooking',
            'existingDetail',
            'otherRoomsInCart',
            'relatedRooms' // Add this line
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

        try {
            // Validate check-in and check-out dates
            $checkIn = strtotime($request->check_in);
            $checkOut = strtotime($request->check_out);
            
            if ($checkIn === $checkOut) {
                return back()->with('error', 'Tanggal check-in dan check-out tidak boleh sama.');
            }

            // Check room availability
            $availableRooms = $room->getAvailableRoomsCount($request->check_in, $request->check_out);
            if ($availableRooms < $request->quantity) {
                return back()->with('error', "Hanya tersedia {$availableRooms} kamar untuk periode yang dipilih.");
            }

            // Check existing booking in cart
            $booking = Booking::firstOrCreate(
                [
                    'user_id' => Auth::id(),
                    'status' => 'cart'  // Pastikan mencari dengan status cart
                ],
                [
                    'homestay_id' => $room->homestay_id,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'base_price' => 0,
                    'service_price' => 0,
                    'total_price' => 0,
                    'status' => 'cart'  // Pastikan set status cart saat create
                ]
            );

            // Check if room is already in cart
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
            $nights = $this->calculateNights($request->check_in, $request->check_out);
            $basePrice = $room->price * $nights;

            // Add booking detail
            BookingDetail::create([
                'booking_id' => $booking->id,
                'room_id' => $room->id,
                'quantity' => $request->quantity,
                'price_per_night' => $room->price,
                'subtotal_price' => $basePrice * $request->quantity
            ]);

            // Update total booking price
            $this->updateBookingTotalPrice($booking);

            DB::commit();
            
            // Redirect ke route yang benar
            return redirect()->route('users.cart')
                ->with('success', 'Kamar berhasil ditambahkan ke keranjang');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Booking error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menambahkan ke keranjang.');
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
        
        $availableRooms = $room->getAvailableRoomsCount($checkIn, $checkOut);

        return response()->json([
            'available_rooms' => $availableRooms
        ]);
    }
}
