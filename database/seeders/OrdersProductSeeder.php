<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_product')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'product_id' => 1,
            ],
            [
                'id' => 2,
                'order_id' => 1,
                'product_id' => 1,
            ],
            [
                'id' => 3,
                'order_id' => 1,
                'product_id' => 1,
            ],
            [
                'id' => 4,
                'order_id' => 2,
                'product_id' => 1,
            ],
            [
                'id' => 5,
                'order_id' => 2,
                'product_id' => 1,
            ],
            [
                'id' => 6,
                'order_id' => 2,
                'product_id' => 1,
            ],
            [
                'id' => 7,
                'order_id' => 3,
                'product_id' => 1,
            ],
            [
                'id' => 8,
                'order_id' => 3,
                'product_id' => 1,
            ],
            [
                'id' => 9,
                'order_id' => 3,
                'product_id' => 1,
            ],
        ]);
    }
}
