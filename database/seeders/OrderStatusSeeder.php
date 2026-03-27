<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'pending'],
            ['name' => 'processing'],
            ['name' => 'shipped'],
            ['name' => 'delivered'],
            ['name' => 'cancelled'],
            ['name' => 'refunded'],
            ['name' => 'failed'],
            ['name' => 'on_hold'],
        ];

        DB::table('order_statuses')->insert($statuses);
    }
}