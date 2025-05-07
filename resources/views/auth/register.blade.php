@extends('layouts.guest')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg flex max-w-4xl w-full overflow-hidden">
        {{-- Kiri: Ilustrasi --}}
        <div class="hidden md:flex w-1/2 bg-indigo-900 items-center justify-center p-10">
            <img src="{{ asset('images/register-illustration.svg') }}" alt="Ilustrasi" class="w-full">
        </div>

        {{-- Kanan: Form --}}
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center mb-6">Buat Akun Anda</h2>

            {{-- Tombol Role --}}
            <div class="flex justify-center gap-4 mb-6">
                <button type="button" onclick="setRole('pengunjung')" id="btn-pengunjung"
                    class="role-btn bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium">Pengunjung</button>
                <button type="button" onclick="setRole('pemilik')" id="btn-pemilik"
                    class="role-btn bg-white border border-indigo-700 text-indigo-700 px-4 py-2 rounded-lg font-medium">Pemilik Rumah</button>
                <button type="button" onclick="setRole('bumdes')" id="btn-bumdes"
                    class="role-btn bg-white border border-indigo-700 text-indigo-700 px-4 py-2 rounded-lg font-medium">BUMDes</button>
            </div>

            <form class="space-y-4">
                <input type="hidden" name="role" id="role" value="pengunjung">

                <input type="text" placeholder="Nama Lengkap"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">

                <input type="email" placeholder="Email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">

                <input type="text" placeholder="No Hp/Whatsapp"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">

                {{-- Dropdown BUMDes (tampil hanya jika role pemilik) --}}
                <div id="bumdes-dropdown" class="hidden">
                    <select
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                        <option value="">Pilih BUMDes</option>
                        <option value="1">BUMDes Suka Maju</option>
                        <option value="2">BUMDes Amanah</option>
                        <option value="3">BUMDes Sejahtera</option>
                    </select>
                </div>

                <input type="password" placeholder="Kata Sandi"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">

                <input type="password" placeholder="Konfirmasi kata sandi"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">

                <button type="submit"
                    class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200">
                    Buat Akun
                </button>
            </form>

            <p class="text-center mt-4 text-sm">
                Apakah sudah punya akun? 
                <a href="#" class="text-indigo-700 font-semibold">Masuk</a>
            </p>
        </div>
    </div>
</div>

{{-- Script untuk toggle role --}}
<script>
    function setRole(role) {
        document.getElementById('role').value = role;

        // Reset semua tombol
        document.querySelectorAll('.role-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-700', 'text-white');
            btn.classList.add('bg-white', 'text-indigo-700', 'border');
        });

        // Aktifkan tombol terpilih
        document.getElementById(`btn-${role}`).classList.add('bg-indigo-700', 'text-white');
        document.getElementById(`btn-${role}`).classList.remove('bg-white', 'text-indigo-700', 'border');

        // Tampilkan dropdown kalau pemilik
        document.getElementById('bumdes-dropdown').classList.toggle('hidden', role !== 'pemilik');
    }
</script>
@endsection
