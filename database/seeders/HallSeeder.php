<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('halls')->insert([
            'name' => 'Sala 3D',
            'base_seats' => 85,
            'sold_base_seats' => 0,
            'vip_seats' => 15,
            'sold_vip_seats' => 0,
            'film_id' => 1,
            'remote_id' => 1
        ]);

        DB::table('halls')->insert([
            'name' => 'Sala Adventure',
            'base_seats' => 88,
            'sold_base_seats' => 0,
            'vip_seats' => 12,
            'sold_vip_seats' => 0,
            'film_id' => 3,
            'remote_id' => 2
        ]);

        DB::table('halls')->insert([
            'name' => 'Sala bambini',
            'base_seats' => 70,
            'sold_base_seats' => 0,
            'vip_seats' => 8,
            'sold_vip_seats' => 0,
            'film_id' => 5,
            'remote_id' => 3
        ]);
    }
}
