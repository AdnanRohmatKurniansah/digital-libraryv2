<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::create([
            'nama_lengkap' => 'Adnan Rohmat Kurniansah',
            'username' => 'adnan',
            'email' => 'atnandimas@gmail.com',
            'password' => Hash::make('999999999'),
            'alamat' => 'pundong',
            'role' => 'administrator'
        ]);

        \App\Models\User::create([
            'nama_lengkap' => 'Peminjam',
            'username' => 'peminjam',
            'email' => 'peminjam@gmail.com',
            'password' => Hash::make('999999999'),
            'alamat' => 'peminjam',
            'role' => 'peminjam'
        ]);
    }
}
