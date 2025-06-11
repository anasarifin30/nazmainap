<?php

namespace App\Http\Controllers\User;

use App\Models\Homestay;
use App\Models\Faq;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\BookingDetail;
use App\Models\Booking;

class UserController extends Controller
{
    public function landingPage()
    {
        // Ambil data homestay untuk ditampilkan di landing page
        $homestaysslide = Homestay::where('status', 'terverifikasi')
            ->with(['rooms', 'coverPhoto'])
            ->paginate(6);

        // Ambil daftar kabupaten unik dari homestay terverifikasi
        $kabupatens = Homestay::where('status', 'terverifikasi')
            ->whereNotNull('kabupaten')
            ->select('kabupaten')
            ->distinct()
            ->get();

        // Ambil FAQ yang aktif dan terurut
        $faqs = Faq::active()->ordered()->get();

        // Kirim data ke view landing page
        return view('users.landingpage', compact('homestaysslide', 'kabupatens', 'faqs'));
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
            'provinsi_nama'    => 'nullable|string|max:100',
            'kabupaten_nama'   => 'nullable|string|max:100',
            'kecamatan_nama'   => 'nullable|string|max:100',
            'kelurahan_nama'   => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'password'    => 'nullable|string|min:8|confirmed',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Filter out "-- Pilih X --" values
        $provinsi = $request->provinsi_nama !== '-- Pilih Provinsi --' ? $request->provinsi_nama : null;
        $kabupaten = $request->kabupaten_nama !== '-- Pilih Kabupaten --' ? $request->kabupaten_nama : null;
        $kecamatan = $request->kecamatan_nama !== '-- Pilih Kecamatan --' ? $request->kecamatan_nama : null;
        $kelurahan = $request->kelurahan_nama !== '-- Pilih Kelurahan --' ? $request->kelurahan_nama : null;

        // Update data
        $user->name      = $request->nama;
        $user->nomorhp   = $request->nohp;
        $user->email     = $request->email;
        $user->address   = $request->alamat;
        $user->provinsi  = $provinsi;
        $user->kabupaten = $kabupaten;
        $user->kecamatan = $kecamatan;
        $user->kelurahan = $kelurahan;
        $user->gender    = $request->jenis_kelamin;

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
            }
            // Simpan foto baru
            $user->foto = $request->file('foto')->store('images-profil', 'public');
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function historycart(Request $request)
    {
        $query = Booking::where('user_id', Auth::id())
            ->where('status', '!=', 'cart')  
            ->with(['homestay', 'homestay.coverPhoto']);

        
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        $riwayats = $query->latest()->paginate(9);

        return view('users.historycart', compact('riwayats'));
    }

    public function historyDetail(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        // Cari transaksi pending yang belum expire
        $pendingTransaction = $booking->transaction()
            ->where('payment_status', 'pending')
            ->latest()
            ->first();

        // Jika ada transaksi pending dan sudah expire, update status
        if ($pendingTransaction && $pendingTransaction->expires_at < now()) {
            $pendingTransaction->update(['payment_status' => 'expire']);
            $booking->update(['status' => 'dibatalkan']);
        }

        // Ambil ulang transaksi pending yang belum expire (jika ada)
        $activeTransaction = $booking->transaction()
            ->where('payment_status', 'pending')
            ->where('expires_at', '>', now())
            ->latest()
            ->first();

        $remaining_seconds = null;
        if ($activeTransaction) {
            $remaining_seconds = (int) now()->diffInSeconds($activeTransaction->expires_at);
        }
        return view('users.detailbooking', [
            'riwayat' => $booking,
            'remaining_seconds' => $remaining_seconds,
        ]);
    }

    public function cart()
    {
        $user = Auth::user();

        // Ambil booking dengan status 'menunggu' (cart aktif)
        $booking = Booking::with([
            'homestay.coverPhoto',
            'bookingDetails.room.roomPhotos',
            'bookingDetails.room.roomFacilities.facility'
        ])
        ->where('user_id', $user->id)
        ->where('status', 'menunggu')
        ->latest()
        ->first();

        return view('users.cart', compact('booking'));
    }

    public function removeCartItem(BookingDetail $bookingDetail)
    {
        // Optional: cek user pemilik
        $bookingDetail->delete();

        // Jika booking tidak punya detail lagi, hapus booking-nya
        if ($bookingDetail->booking->bookingDetails()->count() == 0) {
            $bookingDetail->booking->delete();
        }

        return redirect()->route('users.cart')->with('success', 'Kamar dihapus dari keranjang.');
    }

    public function updateCartItem(Request $request, BookingDetail $bookingDetail)
    {
        $action = $request->input('action');
        if ($action === 'increment') {
            $bookingDetail->quantity += 1;
        } elseif ($action === 'decrement' && $bookingDetail->quantity > 1) {
            $bookingDetail->quantity -= 1;
        }
        // Update subtotal
        $bookingDetail->subtotal_price = $bookingDetail->quantity * $bookingDetail->price_per_night;
        $bookingDetail->save();

        // Update total booking price
        $booking = $bookingDetail->booking;
        $booking->total_price = $booking->bookingDetails()->sum('subtotal_price');
        $booking->save();

        return redirect()->route('users.cart');
    }
}
