<?php

namespace App\Http\Controllers\Admin;

use App\Models\Homestay;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomestayController extends Controller
{
    // Tampilkan halaman homestay
    public function index()
    {
        $homestays = Homestay::all();
        return view('admin.homestay', compact('homestays'));
    }

    public function create()
    {
        return view('admin.homestays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'kodebumdes' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,terverifikasi,ditolak',
        ]);

        // Tambahkan user_id dari pengguna yang sedang login
        Homestay::create(array_merge($request->all(), [
            'user_id' => Auth::user()->id,
        ]));

        return redirect()->route('admin.homestays.index')->with('success', 'Homestay berhasil ditambahkan.');
    }

    public function edit(Homestay $homestay)
    {
        return view('admin.homestays.edit', compact('homestay'));
    }

    public function update(Request $request, Homestay $homestay)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'kodebumdes' => 'nullable|string|max:255',
            'status' => 'required|in:menunggu,terverifikasi,ditolak',
        ]);

        $homestay->update($request->all());
        return redirect()->route('admin.homestays.index')->with('success', 'Homestay berhasil diperbarui.');
    }

    public function destroy(Homestay $homestay)
    {
        $homestay->delete();
        return redirect()->route('admin.homestays.index')->with('success', 'Homestay berhasil dihapus.');
    }



    public function show($id)
{
    $homestay = Homestay::findOrFail($id);
    return view('admin.homestay-detail', compact('homestay'));
}

}
