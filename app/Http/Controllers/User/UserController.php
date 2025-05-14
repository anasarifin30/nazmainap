<?php

namespace App\Http\Controllers\User;

use App\Models\Homestay;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function landingPage()
    {
        // Ambil data homestay untuk ditampilkan di landing page
        $homestaysslide = Homestay::where('status', 'terverifikasi')->paginate(6);
        $homestaysslide->load('rooms');
        
        // Kirim data ke view landing page
        return view('users.landingpage', compact('homestaysslide'));
    }

}
