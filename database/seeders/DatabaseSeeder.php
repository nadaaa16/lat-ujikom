<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::insert([
            [
                'name'     => 'Admin',
                'slug'     => 'admin',
                'email'    => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'telepon'  => '098765432123',
                'alamat'   => 'Tajur',
                'role'     => 'admin',
            ], [
                'name'     => 'Pustakawan',
                'slug'     => 'pustakawan',
                'email'    => 'pustakawan@gmail.com',
                'username' => 'pustakawan',
                'password' => Hash::make('12345678'),
                'telepon'  => '098765432123',
                'alamat'   => 'Tajur',
                'role'     => 'pustakawan',
            ]
        ]);
    }
}
