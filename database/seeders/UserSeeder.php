<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id'=>1,
            'name' => 'momen dahalan',
            'email'=> 'momen@gmail.com',
            'password'=>bcrypt('11111111'),
            'email_verified_at'=> now(),
            'role_id'=>1,
        ]);


        DB::table('users')->insert([
            'id'=>2,
            'name' => 'ahmed dahalan',
            'email'=> 'ahmed@gmail.com',
            'password'=>bcrypt('11111111'),
            'email_verified_at'=> now(),
            'role_id'=>2,
        ]);

        DB::table('users')->insert([
            'id'=>3,
            'name' => 'ans dahalan',
            'email'=> 'ans@gmail.com',
            'password'=>bcrypt('11111111'),
            'email_verified_at'=> now(),
            'role_id'=>2,
        ]);

    }
}
