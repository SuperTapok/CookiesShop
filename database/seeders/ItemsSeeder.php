<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('items')->insert([
            [
                'id' => 1,
                'place_id' => 1,
                'category_id' => 1,
            ],
            [
                'id' => 2,
                'place_id' => 2,
                'category_id' => 1,
            ],
            [
                'id' => 3,
                'place_id' => 3,
                'category_id' => 2,
            ]
        ]);
    }
}
