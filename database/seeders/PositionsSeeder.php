<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('positions')->insert([
            [
                'id' => 1,
                'name' => 'Position 1',
                'company_id' => 2
            ],
            [
                'id' => 2,
                'name' => 'Position 2',
                'company_id' => 2
            ],
            [
                'id' => 3,
                'name' => 'Position 3',
                'company_id' => 2
            ]
        ]);
    }
}
