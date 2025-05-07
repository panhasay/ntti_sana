<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 100,
                'name'=>'Tuo Vansin',
                'department_code'=>'',
                'email'=>'tuodev@gmail.com',
                'permission'=>'admin',
                'user_type'=>'administrator',
                'role'=>'admin',
                'email_verified_at' => Carbon::now(),
                'password'=> bcrypt('password')
            ],
        ];

        DB::table('users')->where('id', 1)->delete();
        DB::table('users')->insert($users);
    }
}
