<?php

namespace Database\Seeders;

use App\Models\Alert;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $alert1= Alert::create([
            'user_id'=>1,
            'alert'=>3
        ]);

        $alert2= Alert::create([
            'user_id'=>2,
            'alert'=>1
        ]);

        $alert1= Alert::create([
            'user_id'=>3,
            'alert'=>0
        ]);
    }
}
