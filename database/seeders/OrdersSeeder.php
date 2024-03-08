<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'paid_at' => fake()->dateTime(),
                'given_at' => fake()->dateTime(),
                'sum' => 150,
                'receipt_code' => '1hj34d',
                'employee_id' => 1
            ],
            [
                'id' => 2,
                'paid_at' => fake()->dateTime(),
                'given_at' => fake()->dateTime(),
                'sum' => 150,
                'receipt_code' => 'cxvli3',
                'employee_id' => 1
            ],
            [
                'id' => 3,
                'paid_at' => fake()->dateTime(),
                'given_at' => fake()->dateTime(),
                'sum' => 150,
                'receipt_code' => 'njhd31',
                'employee_id' => 1
            ],
            [
                'id' => 4,
                'paid_at' => fake()->dateTime(),
                'given_at' => fake()->dateTime(),
                'sum' => 150,
                'receipt_code' => 'kj23h4',
                'employee_id' => 1
            ]
        ]);
    }
}
