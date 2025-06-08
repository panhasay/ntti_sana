<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'developer251121@gmail.com'], // Search criteria
            [
                'pageination' => 1,
                'name' => 'Admin User',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'remember_token' => Str::random(10),
                'user_code' => 'ADM001',
                'user_type' => 'admin',
                'role' => 'admin',
                'permission' => 'full',
                'phone' => 1234567890,
                'fcm_token' => Str::random(64),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'pageination' => 2,
                'name' => 'Regular User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'user_code' => 'USR001',
                'user_type' => 'user',
                'role' => 'member',
                'permission' => 'limited',
                'phone' => 9876543210,
                'fcm_token' => Str::random(64),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
