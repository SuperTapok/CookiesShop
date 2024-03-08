<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('course_theme')->insert([
            [
                'id' => 1,
                'course_id' => 1,
                'theme_id' => 1,
            ],
            [
                'id' => 2,
                'course_id' => 1,
                'theme_id' => 2,
            ],
            [
                'id' => 3,
                'course_id' => 1,
                'theme_id' => 3,
            ],
            [
                'id' => 4,
                'course_id' => 2,
                'theme_id' => 2,
            ],
            [
                'id' => 5,
                'course_id' => 3,
                'theme_id' => 3,
            ],

        ]);
    }
}
