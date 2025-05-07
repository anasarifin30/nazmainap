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
        $users = [];
        for ($i = 1; $i <= 20; $i++) {
            $role = match (true) {
                $i === 1 => 'admin',
                $i % 3 === 0 => 'owner',
                $i % 2 === 0 => 'subadmin',
                default => 'guest',
            };

            $users[] = [
                'name' => "User $i",
                'email' => "user$i@nazma.com",
                'password' => bcrypt('password'),
                'nomorhp' => '08' . str_pad($i, 10, '0', STR_PAD_LEFT),
                'provinsi' => 'Jawa Tengah',
                'kabupaten' => 'Kebumen',
                'kecamatan' => "Kecamatan $i",
                'address' => "Alamat $i",
                'gender' => $i % 2 == 0 ? 'L' : 'P',
                'foto' => null,
                'role' => $role,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        User::insert($users);
    }
}
