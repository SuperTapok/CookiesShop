<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'id' => 1,
                'name' => fake('ru_RU')->firstName(),
                'surname' => fake('ru_RU')->lastName(),
                'middle_name' => fake('ru_RU')->firstName(),
                'cookies_num' => 100,
                'position_id' => 1
            ],
            [
                'id' => 2,
                'name' => fake('ru_RU')->firstName(),
                'surname' => fake('ru_RU')->lastName(),
                'middle_name' => fake('ru_RU')->firstName(),
                'cookies_num' => 100,
                'position_id' => 2
            ],
            [
                'id' => 3,
                'name' => fake('ru_RU')->firstName(),
                'surname' => fake('ru_RU')->lastName(),
                'middle_name' => fake('ru_RU')->firstName(),
                'cookies_num' => 100,
                'position_id' => 3
            ],
            [
                'id' => 4,
                'name' => fake('ru_RU')->firstName(),
                'surname' => fake('ru_RU')->lastName(),
                'middle_name' => fake('ru_RU')->firstName(),
                'cookies_num' => 100,
                'position_id' => 2
            ]
        ]);
    }
}
