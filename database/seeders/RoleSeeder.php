<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'role'=>'مدير'
        ]);

        DB::table('roles')->insert([
            'role'=>'مستخدم فعال'
        ]);

        DB::table('roles')->insert([
            'role'=>'مستخدم جديد'
        ]);
    }
}
