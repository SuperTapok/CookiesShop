<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => fake()->firstName(),
                'email' =>fake('ru_RU')->email(),
                'email_verified_at' => now(),
                'password' => bcrypt('user'),
                'remember_token' => Str::random(10),
                'employee_id' => 1,
                'user_type_id' => 1
            ],
            [
                'id' => 2,
                'name' => fake()->firstName(),
                'email' =>fake('ru_RU')->email(),
                'email_verified_at' => now(),
                'password' => bcrypt('admin'),
                'remember_token' => Str::random(10),
                'employee_id' => 2,
                'user_type_id' => 2
            ],
            [
                'id' => 3,
                'name' => fake()->firstName(),
                'email' =>fake('ru_RU')->email(),
                'email_verified_at' => now(),
                'password' => bcrypt('manager'),
                'remember_token' => Str::random(10),
                'employee_id' => 3,
                'user_type_id' => 3
            ],
            [
                'id' => 4,
                'name' => fake()->firstName(),
                'email' => fake('ru_RU')->email(),
                'email_verified_at' => now(),
                'password' => bcrypt('moderator'),
                'remember_token' => Str::random(10),
                'employee_id' => 4,
                'user_type_id' => 4
            ],
        ]);
    }
}
