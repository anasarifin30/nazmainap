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
        $query = Homestay::query();

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('address', 'like', '%' . $request->search . '%');
        }

        $homestays = $query->paginate(12);

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