<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homestay;




class HomestayController extends Controller
{
    // Display a listing of the homestays
    public function index(Request $request)
    {
        $query = Homestay::with(['coverPhoto', 'rooms']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('kabupaten', 'like', '%' . $search . '%')
                  ->orWhere('kecamatan', 'like', '%' . $search . '%')
                  ->orWhere('kelurahan', 'like', '%' . $search . '%');
            });
        }

        // Ambil semua, lalu groupBy kabupaten
        $homestays = $query->where('status', 'terverifikasi')->get()->groupBy('kabupaten');

        return view('users.kataloghomestay', compact('homestays'));
    }


    // Show the details of a specific homestay
    public function show($id)
    {
        $homestay = Homestay::with(['coverPhoto', 'photos', 'rooms.photos', 'rules'])->findOrFail($id);
        return view('users.detailhomestay', compact('homestay'));
    }

    public function photos($id)
    {
        $homestay = \App\Models\Homestay::with([
            'photos.category' // relasi ke kategori pada foto homestay
        ])->findOrFail($id);

        // Ambil semua kategori yang memiliki foto pada homestay ini
        $categories = \App\Models\PhotoCategory::whereHas('homestayPhotos', function($q) use ($id) {
            $q->where('homestay_id', $id);
        })->with(['homestayPhotos' => function($q) use ($id) {
            $q->where('homestay_id', $id);
        }])->get();

        return view('users.allphotohomestay', compact('homestay', 'categories'));
    }
    
}