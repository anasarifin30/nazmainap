<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Room;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show($id)
    {
        $room = Room::with(['photos', 'facilities'])->findOrFail($id);

        // Ambil kamar lain yang terkait dengan homestay yang sama
        $relatedRooms = Room::where('homestay_id', $room->homestay_id)
                            ->where('id', '!=', $room->id) // Kecualikan kamar yang sedang ditampilkan
                            ->with('photos') // Muat foto kamar
                            ->take(3) // Batasi jumlah kamar yang ditampilkan
                            ->get();

        return view('users.detailrooms', compact('room', 'relatedRooms'));
    }
}
