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
            ['user_id' => 3, 'kodebumdes' => 'BDSA001', 'name' => 'Homestay Mawar', 'description' => 'Penginapan nyaman di pusat desa.', 'address' => 'Desa A, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 4, 'kodebumdes' => 'BDSA002', 'name' => 'Homestay Melati', 'description' => 'Penginapan asri dengan pemandangan sawah.', 'address' => 'Desa B, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 5, 'kodebumdes' => 'BDSA003', 'name' => 'Homestay Anggrek', 'description' => 'Penginapan modern dengan fasilitas lengkap.', 'address' => 'Desa C, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 6, 'kodebumdes' => 'BDSA004', 'name' => 'Homestay Dahlia', 'description' => 'Penginapan nyaman di dekat pasar desa.', 'address' => 'Desa D, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 7, 'kodebumdes' => 'BDSA005', 'name' => 'Homestay Kenanga', 'description' => 'Penginapan dengan suasana pedesaan.', 'address' => 'Desa E, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 8, 'kodebumdes' => 'BDSA006', 'name' => 'Homestay Cempaka', 'description' => 'Penginapan dekat dengan objek wisata.', 'address' => 'Desa F, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 9, 'kodebumdes' => 'BDSA007', 'name' => 'Homestay Teratai', 'description' => 'Penginapan dengan fasilitas kolam renang.', 'address' => 'Desa G, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 10, 'kodebumdes' => 'BDSA008', 'name' => 'Homestay Kamboja', 'description' => 'Penginapan dengan suasana tenang.', 'address' => 'Desa H, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 11, 'kodebumdes' => 'BDSA009', 'name' => 'Homestay Bougenville', 'description' => 'Penginapan dengan taman bunga.', 'address' => 'Desa I, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 12, 'kodebumdes' => 'BDSA010', 'name' => 'Homestay Flamboyan', 'description' => 'Penginapan dengan fasilitas olahraga.', 'address' => 'Desa J, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 13, 'kodebumdes' => 'BDSA011', 'name' => 'Homestay Sakura', 'description' => 'Penginapan dengan nuansa Jepang.', 'address' => 'Desa K, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 14, 'kodebumdes' => 'BDSA012', 'name' => 'Homestay Lavender', 'description' => 'Penginapan dengan aroma terapi.', 'address' => 'Desa L, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 15, 'kodebumdes' => 'BDSA013', 'name' => 'Homestay Magnolia', 'description' => 'Penginapan dengan fasilitas spa.', 'address' => 'Desa M, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 16, 'kodebumdes' => 'BDSA014', 'name' => 'Homestay Jasmine', 'description' => 'Penginapan dengan suasana romantis.', 'address' => 'Desa N, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 17, 'kodebumdes' => 'BDSA015', 'name' => 'Homestay Lily', 'description' => 'Penginapan dengan fasilitas keluarga.', 'address' => 'Desa O, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 18, 'kodebumdes' => 'BDSA016', 'name' => 'Homestay Orchid', 'description' => 'Penginapan dengan fasilitas bisnis.', 'address' => 'Desa P, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 19, 'kodebumdes' => 'BDSA017', 'name' => 'Homestay Sunflower', 'description' => 'Penginapan dengan pemandangan matahari terbit.', 'address' => 'Desa Q, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 20, 'kodebumdes' => 'BDSA018', 'name' => 'Homestay Rose', 'description' => 'Penginapan dengan fasilitas mewah.', 'address' => 'Desa R, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 1, 'kodebumdes' => 'BDSA019', 'name' => 'Homestay Tulip', 'description' => 'Penginapan dengan desain minimalis.', 'address' => 'Desa S, Kutowinangun', 'status' => 'verified'],
            ['user_id' => 2, 'kodebumdes' => 'BDSA020', 'name' => 'Homestay Marigold', 'description' => 'Penginapan dengan fasilitas ramah lingkungan.', 'address' => 'Desa T, Kutowinangun', 'status' => 'verified'],
        ];

        foreach ($homestays as $homestay) {
            Homestay::create($homestay);
        }
    }
}
