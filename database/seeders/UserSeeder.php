<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

         User::create([
            'name' => 'User',
            'email' => 'User@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 2,
        ]);
    }
}
