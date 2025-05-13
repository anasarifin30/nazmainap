<?php

namespace App\Http\Controllers;

use App\Models\Homestay;

class UserController extends Controller
{
    public function landingPage()
    {
        // Ambil data homestay untuk ditampilkan di landing page
        $homestaysslide = Homestay::where('status', 'verified')->paginate(6);

        // Kirim data ke view landing page
        return view('users.landingpage', compact('homestaysslide'));
    }
}
