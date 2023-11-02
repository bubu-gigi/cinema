<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tickets')->insert([
            'price' => 8.5,
            'vip_price' => null,
            'percentage_increase' => 8,
            'film_id' => 1,
            'film_title' => 'The 100',
            'hall_id' => 1,
            'remote_id' => 1
        ]);

        DB::table('tickets')->insert([
            'price' => 12.7,
            'vip_price' => null,
            'percentage_increase' => 5,
            'film_id' => 3,
            'film_title' => 'Mr bean',
            'hall_id' => 2,
            'remote_id' => 2
        ]);
    }
}
