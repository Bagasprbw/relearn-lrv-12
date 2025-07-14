<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        // Bagas - super admin
        User::create([
            'name' => 'Bagas',
            'email' => 'bagas@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'address' => 'Alamat Bagas',
            'role_id' => 1,
        ]);

        // Prabowo - admin
        User::create([
            'name' => 'Prabowo',
            'email' => 'prabowo@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'address' => 'Alamat Prabowo',
            'role_id' => 2,
        ]);

        // Samwan i luv <3 - user
        User::create([
            'name' => 'Samwan i luv <3',
            'email' => 'samwan@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'address' => 'Alamat Samwan',
            'role_id' => 3, 
        ]);
    }
    }
}
