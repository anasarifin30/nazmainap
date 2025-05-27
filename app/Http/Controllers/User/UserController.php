<?php

namespace App\Http\Controllers\User;

use App\Models\Homestay;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function landingPage()
    {
        // Ambil data homestay untuk ditampilkan di landing page
        $homestaysslide = Homestay::where('status', 'terverifikasi')
            ->with(['rooms', 'coverPhoto'])
            ->paginate(6);

        // Kirim data ke view landing page
        return view('users.landingpage', compact('homestaysslide'));
    }


    public function profile()
    {
        $user = \App\Models\User::find(Auth::id());
        return view('users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = \App\Models\User::find(Auth::id());

        $request->validate([
            'nama'        => 'required|string|max:255',
            'nohp'        => 'required|string|max:20',
            'email'       => 'required|email|max:255|unique:users,email,' . $user->id,
            'alamat'      => 'nullable|string|max:255',
            'provinsi'    => 'nullable|string|max:100',
            'kabupaten'   => 'nullable|string|max:100',
            'kecamatan'   => 'nullable|string|max:100',
            'kelurahan'   => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'password'    => 'nullable|string|min:8|confirmed',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data
        $user->name      = $request->nama;
        $user->nomorhp   = $request->nohp;
        $user->email     = $request->email;
        $user->address   = $request->alamat;
        $user->provinsi  = $request->provinsi_nama;
        $user->kabupaten = $request->kabupaten_nama;
        $user->kecamatan = $request->kecamatan_nama;
        $user->kelurahan = $request->kelurahan_nama;
        $user->gender    = $request->jenis_kelamin;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
            \Storage::disk('public')->delete($user->foto);
            }
            // Simpan foto baru
            $user->foto = $request->file('foto')->store('images-profil', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function historycart(Request $request)
    {
        $user = Auth::user();
        $status = $request->get('status'); // status: aktif, selesai, dibatalkan, menunggu

        $query = \App\Models\Booking::with(['homestay.coverPhoto'])
            ->where('user_id', $user->id);

        if ($status && $status != 'semua') {
            $query->where('status', $status);
        }

        $riwayats = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();

        return view('users.historycart', compact('riwayats', 'status'));
    }

    public function historyDetail($bookingId)
    {
        $riwayat = \App\Models\Booking::with([
            'homestay',
            'bookingDetails.room'
        ])->where('id', $bookingId)
          ->where('user_id', Auth::id())
          ->firstOrFail();

        return view('users.detailbooking', compact('riwayat'));
    }
}
