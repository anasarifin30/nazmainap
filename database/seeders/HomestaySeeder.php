<?php

namespace Database\Seeders;

use App\Models\Homestay;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HomestaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $homestays = [
            ['user_id' => 3, 'kodebumdes' => 'BDSA001', 'name' => 'Homestay Mawar', 'description' => 'Penginapan nyaman di pusat desa.', 'address' => 'Desa A, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 4, 'kodebumdes' => 'BDSA002', 'name' => 'Homestay Melati', 'description' => 'Penginapan asri dengan pemandangan sawah.', 'address' => 'Desa B, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 5, 'kodebumdes' => 'BDSA003', 'name' => 'Homestay Anggrek', 'description' => 'Penginapan modern dengan fasilitas lengkap.', 'address' => 'Desa C, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 6, 'kodebumdes' => 'BDSA004', 'name' => 'Homestay Dahlia', 'description' => 'Penginapan nyaman di dekat pasar desa.', 'address' => 'Desa D, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 7, 'kodebumdes' => 'BDSA005', 'name' => 'Homestay Kenanga', 'description' => 'Penginapan dengan suasana pedesaan.', 'address' => 'Desa E, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 8, 'kodebumdes' => 'BDSA006', 'name' => 'Homestay Cempaka', 'description' => 'Penginapan dekat dengan objek wisata.', 'address' => 'Desa F, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 9, 'kodebumdes' => 'BDSA007', 'name' => 'Homestay Teratai', 'description' => 'Penginapan dengan fasilitas kolam renang.', 'address' => 'Desa G, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 10, 'kodebumdes' => 'BDSA008', 'name' => 'Homestay Kamboja', 'description' => 'Penginapan dengan suasana tenang.', 'address' => 'Desa H, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 11, 'kodebumdes' => 'BDSA009', 'name' => 'Homestay Bougenville', 'description' => 'Penginapan dengan taman bunga.', 'address' => 'Desa I, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
            ['user_id' => 12, 'kodebumdes' => 'BDSA010', 'name' => 'Homestay Flamboyan', 'description' => 'Penginapan dengan fasilitas olahraga.', 'address' => 'Desa J, Kutowinangun', 'provinsi' => 'Jawa Tengah', 'kabupaten' => 'Kebumen', 'kecamatan' => 'Kutowinangun', 'status' => 'terverifikasi'],
        ];

        foreach ($homestays as $homestay) {
            Homestay::create($homestay);
        }
    }
}
