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
        User::updateOrCreate([
            'pageination' => 1,
            'name' => 'Admin User',
            'email' => 'developer251121@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
            'user_code' => 'ADM001',
            'created_at' => now(),
            'updated_at' => now(),
            'user_type' => 'admin',
            'role' => 'administrator',
            'permission' => 'full',
            'phone' => 1234567890,
            'fcm_token' => Str::random(64),
        ]);

        User::create([
            'pageination' => 2,
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'user_code' => 'USR001',
            'created_at' => now(),
            'updated_at' => now(),
            'user_type' => 'user',
            'role' => 'member',
            'permission' => 'limited',
            'phone' => 9876543210,
            'fcm_token' => Str::random(64),
        ]);
    }
}
