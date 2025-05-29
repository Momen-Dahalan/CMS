<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            'body'=> 'شكرا جزيلا',
            'post_id'=>1,
            'user_id'=>2,
            'created_at'=>Carbon::now(),
            'commentable_id'=>1,
            'commentable_type'=>'App\Models\Post'
        ]);

        DB::table('comments')->insert([
            'body'=> 'مقال جيد',
            'post_id'=>1,
            'user_id'=>3,
            'created_at'=>Carbon::now(),
            'commentable_id'=>1,
            'commentable_type'=>'App\Models\Post'
        ]);

        DB::table('comments')->insert([
            'body'=> 'مقال مفيد',
            'post_id'=>2,
            'user_id'=>2,
            'created_at'=>Carbon::now(),
            'commentable_id'=>1,
            'commentable_type'=>'App\Models\Post'
        ]);
    }
}
