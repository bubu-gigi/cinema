<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('films')->insert([
            'title' => 'The 100',
            'status' => 'avaiable',
            'description' => null,
            'director' => null,
            'producer' => null,
            'release_date' => 'null',
            'remote_id' => 1,
            'time' => null,
            'pellicole' => 17,
            'daily_gain' => 0,
            'tot_gain' => 0
        ]);

        DB::table('films')->insert([
            'title' => 'Prison Break',
            'status' => 'expired',
            'description' => null,
            'director' => null,
            'producer' => null,
            'release_date' => null,
            'remote_id' => 2,
            'time' => null,
            'pellicole' => 0,
            'daily_gain' => 0,
            'tot_gain' => 0
        ]);

        DB::table('films')->insert([
            'title' => 'Mr bean',
            'status' => 'incoming',
            'description' => null,
            'director' => null,
            'producer' => null,
            'release_date' => '17/01/2024',
            'remote_id' => 3,
            'time' => null,
            'pellicole' => 200,
            'daily_gain' => 0,
            'tot_gain' => 0
        ]);

        DB::table('films')->insert([
            'title' => 'Pantera rosa',
            'status' => 'expired',
            'description' => null,
            'director' => null,
            'producer' => null,
            'release_date' => null,
            'remote_id' => 4,
            'time' => null,
            'pellicole' => 0,
            'daily_gain' => 0,
            'tot_gain' => 0
        ]);

        DB::table('films')->insert([
            'title' => 'White horse',
            'status' => 'avaiable',
            'description' => null,
            'director' => null,
            'producer' => null,
            'release_date' => null,
            'remote_id' => 5,
            'time' => null,
            'pellicole' => 170,
            'daily_gain' => 0,
            'tot_gain' => 0
        ]);
    }
}
