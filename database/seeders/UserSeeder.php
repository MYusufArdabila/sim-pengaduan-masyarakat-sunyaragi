<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Kelurahan
        User::create([
            'name'     => 'Admin Kelurahan',
            'email'    => 'admin@kelurahan.go.id',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Akun Warga Anonim (5 akun)
        $wargas = [
            ['name' => 'Warga_0001', 'email' => 'warga1@gmail.com'],
            ['name' => 'Warga_0002', 'email' => 'warga2@gmail.com'],
            ['name' => 'Warga_0003', 'email' => 'warga3@gmail.com'],
            ['name' => 'Warga_0004', 'email' => 'warga4@gmail.com'],
            ['name' => 'Warga_0005', 'email' => 'warga5@gmail.com'],
        ];

        foreach ($wargas as $warga) {
            User::create([
                'name'     => $warga['name'],
                'email'    => $warga['email'],
                'password' => Hash::make('password'),
                'role'     => 'warga',
            ]);
        }
    }
}
