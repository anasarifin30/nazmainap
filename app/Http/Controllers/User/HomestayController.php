<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homestay;




class HomestayController extends Controller
{
    // Display a listing of the homestays
    public function index()
    {
        $homestays = Homestay::latest()->paginate(12); // Atau sesuaikan jumlahnya
        return view('users.kataloghomestay', compact('homestays'));
    }

    // Show the details of a specific homestay
    public function show($id)
    {
        $homestay = Homestay::findOrFail($id);
        return view('users.detailhomestay', compact('homestay'));
    }

    // Search for homestays
    public function search(Request $request)
    {
        $query = $request->input('query');
        $homestays = Homestay::where('name', 'like', '%' . $query . '%')->get();
        return view('user.homestays.search', compact('homestays', 'query'));
    }
}