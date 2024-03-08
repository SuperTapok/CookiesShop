<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->insert([
            [
                'id' => 1,
                'name' => fake()->name(),
                'cookies' => 5,
                'description' => fake()->text(),
            ],
            [
                'id' => 2,
                'name' => fake()->name(),
                'cookies' => 10,
                'description' => fake()->text(),
            ],
            [
                'id' => 3,
                'name' => fake()->name(),
                'cookies' => 15,
                'description' => fake()->text(),
            ]
        ]);
    }
}
