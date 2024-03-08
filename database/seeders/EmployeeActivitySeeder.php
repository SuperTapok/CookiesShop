<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee_activity')->insert([
            [
                'id' => 1,
                'employee_id' => 1,
                'activity_id' => 1,
                'given_at' => fake()->dateTime()
            ],
            [
                'id' => 2,
                'employee_id' => 2,
                'activity_id' => 1,
                'given_at' => fake()->dateTime()
            ],
            [
                'id' => 3,
                'employee_id' => 3,
                'activity_id' => 1,
                'given_at' => fake()->dateTime()
            ],
            [
                'id' => 4,
                'employee_id' => 4,
                'activity_id' => 1,
                'given_at' => fake()->dateTime()
            ]
        ]);
    }
}
