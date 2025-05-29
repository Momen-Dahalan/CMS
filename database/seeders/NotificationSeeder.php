<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            'user_id'=>2,
            'post_id'=>2,
            'post_userId'=>1,
        ]);

        DB::table('notifications')->insert([
            'user_id'=>2,
            'post_id'=>2,
            'post_userId'=>1,
        ]);

        DB::table('notifications')->insert([
            'user_id'=>3,
            'post_id'=>3,
            'post_userId'=>2,
        ]);
    }
}
