<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            'title'=> 'لماذا يقوم اللاعبون بلعب كرة القدم ؟',
            'slug' => 'لماذا-يقوم-اللاعبون-بلعب-كرة-القدم',
            'body'=> '<p>يلعبون كرة القدم لكي يحققو البطولات وتعزز التعاون وتحافظ عللى الجسم وتكسب الصحة</p>',
            'user_id'=>3, 
            'approved'=>true,
            'category_id'=>1,
            'created_at'=>now(),
            'image_path'=>'politica.png'
        ]);

        DB::table('posts')->insert([
            'title'=> 'لماذا يقوم اللاعبون بلعب كرة القدم ؟',
            'slug' => 'لماذا-يقوم-اللاعبون-بلعب-كرة-القدم',
            'body'=> '<p>يلعبون كرة القدم لكي يحققو البطولات وتعزز التعاون وتحافظ عللى الجسم وتكسب الصحة</p>',
            'user_id'=>1, 
            'approved'=>true,
            'category_id'=>3,
            'created_at'=>now(),
            'image_path'=>'politica.png'
        ]);

         DB::table('posts')->insert([
            'title'=> 'لماذا يقوم اللاعبون بلعب كرة القدم ؟',
            'slug' => 'لماذا-يقوم-اللاعبون-بلعب-كرة-القدم',
            'body'=> '<p>يلعبون كرة القدم لكي يحققو البطولات وتعزز التعاون وتحافظ عللى الجسم وتكسب الصحة</p>',
            'user_id'=>2, 
            'approved'=>true,
            'category_id'=>2,
            'created_at'=>now(),
            'image_path'=>'politica.png'
        ]);
    }
}
