<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            [
                'id' => 1,
                'name' => 'User',
            ],
            [
                'id' => 2,
                'name' => 'Admin',
            ],
            [
                'id' => 3,
                'name' => 'Manager',
            ],
            [
                'id' => 4,
                'name' => 'Moderator',
            ],
        ]);
    }
}
