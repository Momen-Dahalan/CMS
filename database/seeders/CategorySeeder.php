<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'title'=> 'رياضة ',
            'slug'=> 'رياضة',
            'created_at'=>Carbon::now()
        ]);

        DB::table('categories')->insert([
            'title'=> 'ثقافة ',
            'slug'=> 'ثقافة',
            'created_at'=>Carbon::now()
        ]);
        
        DB::table('categories')->insert([
            'title'=> 'فن ',
            'slug'=> 'فن',
            'created_at'=>Carbon::now()
        ]);

        DB::table('categories')->insert([
            'title'=> 'تعليم ',
            'slug'=> 'تعليم',
            'created_at'=>Carbon::now()
        ]);

        DB::table('categories')->insert([
            'title'=> 'تكنولوجيا ',
            'slug'=> 'تكنولوجيا',
            'created_at'=>Carbon::now()
        ]);
    }
}
