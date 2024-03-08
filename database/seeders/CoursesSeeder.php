<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->insert([
            [
                'id' => 1,
                'url' => 'https://123.com',
                'start_date' => fake()->dateTime(),
                'end_date' => fake()->dateTime(),
                'provider_id' => 1
            ],
            [
                'id' => 2,
                'url' => 'https://123.com',
                'start_date' => fake()->dateTime(),
                'end_date' => fake()->dateTime(),
                'provider_id' => 2
            ],
            [
                'id' => 3,
                'url' => 'https://123.com',
                'start_date' => fake()->dateTime(),
                'end_date' => fake()->dateTime(),
                'provider_id' => 3
            ]
        ]);
    }
}
