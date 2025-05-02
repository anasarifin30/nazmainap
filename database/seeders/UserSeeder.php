<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@nazma.com',
                'password' => bcrypt('password'),
                'nomorhp' => '081234567890',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Kebumen',
                'kecamatan' => 'Kutowinangun',
                'address' => 'Jl. Raya No. 1',
                'gender' => 'L',
                'foto' => null,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'BUMDes Desa A',
                'email' => 'subadmin@desa-a.com',
                'password' => bcrypt('password'),
                'nomorhp' => '081111111111',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Kebumen',
                'kecamatan' => 'Desa A',
                'address' => 'Kantor Desa A',
                'gender' => 'L',
                'foto' => null,
                'role' => 'subadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pemilik Rumah 1',
                'email' => 'owner1@nazma.com',
                'password' => bcrypt('password'),
                'nomorhp' => '082222222222',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Kebumen',
                'kecamatan' => 'Desa A',
                'address' => 'RT 02 RW 01',
                'gender' => 'P',
                'foto' => null,
                'role' => 'owner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User Pengunjung',
                'email' => 'guest@nazma.com',
                'password' => bcrypt('password'),
                'nomorhp' => '083333333333',
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Banyumas',
                'kecamatan' => 'Purwokerto',
                'address' => 'Jl. Melati No. 12',
                'gender' => 'P',
                'foto' => null,
                'role' => 'guest',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
