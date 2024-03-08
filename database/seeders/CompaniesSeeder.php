<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'id' => 1,
                'name' => 'Company1',
            ],
            [
                'id' => 2,
                'name' => 'Company2',
            ],
            [
                'id' => 3,
                'name' => 'Company3',
            ]
        ]);
    }
}
