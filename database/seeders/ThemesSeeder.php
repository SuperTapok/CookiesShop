<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('themes')->insert([
            [
                'id' => 1,
                'name' => fake()->name(),
            ],
            [
                'id' => 2,
                'name' => fake()->name(),
            ],
            [
                'id' => 3,
                'name' => fake()->name(),
            ]
        ]);
    }
}
