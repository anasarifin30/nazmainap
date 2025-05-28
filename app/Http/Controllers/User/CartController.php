<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\BookingDetail;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function update(Request $request, BookingDetail $bookingDetail)
    {
        $room = $bookingDetail->room;
        
        if ($room->total_rooms == 1) {
            return response()->json([
                'success' => false,
                'message' => 'Kamar ini hanya tersedia 1 unit.'
            ]);
        }

        $currentQuantity = $bookingDetail->quantity;
        $action = $request->input('action');
        
        // Calculate new quantity
        $newQuantity = $action === 'increment' ? $currentQuantity + 1 : $currentQuantity - 1;

        // Validate quantity
        if ($newQuantity < 1 || $newQuantity > $room->total_rooms) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah kamar tidak valid.'
            ]);
        }

        // Update booking detail
        $bookingDetail->update([
            'quantity' => $newQuantity,
            'subtotal_price' => $room->price * $newQuantity * $bookingDetail->getTotalNights()
        ]);

        // Update booking totals
        $booking = $bookingDetail->booking;
        $totalBasePrice = $booking->bookingDetails->sum('subtotal_price');
        $totalServicePrice = $totalBasePrice * 0.05;

        $booking->update([
            'base_price' => $totalBasePrice,
            'service_price' => $totalServicePrice,
            'total_price' => $totalBasePrice + $totalServicePrice
        ]);

        return response()->json([
            'success' => true,
            'quantity' => $newQuantity,
            'subtotal_price' => $bookingDetail->subtotal_price,
            'total_base_price' => $totalBasePrice,
            'service_price' => $totalServicePrice,
            'total_price' => $totalBasePrice + $totalServicePrice,
            'max_rooms' => $room->total_rooms
        ]);
    }
}