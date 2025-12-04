<?php

namespace Database\Seeders;

use App\Models\Admin; // Panggil model Admin
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Untuk hash password

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'nama_admin' => 'Sekretaris UKM PIKMA',
            'username' => 'admin_pikma', // Username untuk login
            'email' => 'admin@pikma.com',
            'password_hash' => Hash::make('password123'), // Password untuk login
        ]);
    }
}