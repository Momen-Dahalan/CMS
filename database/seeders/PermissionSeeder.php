<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'name'=>'add-post',
            'description'=>'اضافة المواضيع'
        ]);

        DB::table('permissions')->insert([
            'name'=>'edit-post',
            'description'=>'تعديل المواضيع'
        ]);

        DB::table('permissions')->insert([
            'name'=>'delete-post',
            'description'=>'حذف المواضيع'
        ]);

        DB::table('permissions')->insert([
            'name'=>'add-user',
            'description'=>'اضافة المستخدمين'
        ]);

        DB::table('permissions')->insert([
            'name'=>'edit-user',
            'description'=>'تعديل المستخدمين'
        ]);

        DB::table('permissions')->insert([
            'name'=>'delete-user',
            'description'=>'حذف المستخدمين'
        ]);
    }
}
