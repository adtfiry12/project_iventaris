<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::create([
            'nama'     => 'Aditya Mukti F',
            'username' => 'adtfiry',
            'email'    => 'mfaditya280@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'image'    => null,
        ]);
    }
}
