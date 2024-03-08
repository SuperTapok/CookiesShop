<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            [
                'id' => 1,
                'url' => 'uploads/images/термокружка.jpg',
            ],
            [
                'id' => 2,
                'url' => 'uploads/images/термокружка_2.jpg',
            ],
            [
                'id' => 3,
                'url' => 'uploads/images/термокружка_3.jpg',
            ]
        ]);
    }
}
