<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'user_profile'      => 'Admin',
            'user_namalengkap'  => 'admin',
            'user_username'  => 'admin',
            'user_password'  => bcrypt('123'),
            'user_level'     => 1,
            'user_nohp'      => '08123456789',
            'user_tglahir'  => '1990-01-01',
            'user_nik'       => '1234567890123456',
        ]);
    }
}
