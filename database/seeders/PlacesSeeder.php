<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('places')->insert([
            [
                'id' => 1,
                'address' => fake()->city(),
            ],
            [
                'id' => 2,
                'address' => fake()->city(),
            ],
            [
                'id' => 3,
                'address' => fake()->city(),
            ]
        ]);
    }
}
