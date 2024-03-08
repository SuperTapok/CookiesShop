<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_image')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'image_id' => 1,
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'image_id' => 2,
            ],
            [
                'id' => 3,
                'product_id' => 1,
                'image_id' => 3,
            ]
        ]);
    }
}
