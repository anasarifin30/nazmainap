<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; 
use App\Models\Homestay;

class UserController extends Controller
{
    // Tampilkan halaman user
    public function index()
    {
        $users = User::all();
        return view('admin.user', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.createUser');
    }

    // Simpan data user baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nomorhp' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'gender' => 'required|in:L,P',
            'role' => 'required|in:admin,subadmin,owner,guest',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('images-profil', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomorhp' => $request->nomorhp,
            'address' => $request->address,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'gender' => $request->gender,
            'role' => $request->role,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    
    // Tampilkan form edit user
    public function edit(User $user)
    {
        return view('admin.editUser', compact('user'));
    }

    // Update data user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'nomorhp' => 'required|string|max:15',
            'address' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:100',
            'kabupaten' => 'nullable|string|max:100',
            'kecamatan' => 'nullable|string|max:100',
            'gender' => 'required|in:L,P',
            'role' => 'required|in:admin,subadmin,owner,guest',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'nomorhp', 'address', 'provinsi', 'kabupaten', 'kecamatan', 'gender', 'role']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $data = $request->only(['name', 'email', 'nomorhp', 'address', 'provinsi', 'kabupaten', 'kecamatan', 'gender', 'role']);

        if ($request->hasFile('foto')) {
            if ($user->foto && \Storage::disk('public')->exists($user->foto)) {
                \Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $request->file('foto')->store('images-profil', 'public');
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }
        
    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function landingPage()
    {
        // Ambil data homestay untuk ditampilkan di landing page
        $homestaysslide = Homestay::where('status', 'verified')->paginate(6);

        // Kirim data ke view landing page
        return view('users.landingpage', compact('homestaysslide'));
    }
}
