<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Термокружка',
                'cost' => 50,
                'count' => 20,
                'description' => fake()->text(),
                'is_available' => 1,
                'typeable_type' => 'App\Models\Item',
                'typeable_id' => 1
            ],
            [
                'id' => 2,
                'name' => fake()->text(),
                'cost' => 100,
                'count' => 10,
                'description' => fake()->text(),
                'is_available' => 1,
                'typeable_type' => 'App\Models\Course',
                'typeable_id' => 1
            ]
        ]);
    }
}
