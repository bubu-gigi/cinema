<?php

namespace App\Console\Commands;

use App\Models\Film;
use App\Models\Hall;
use Illuminate\Console\Command;

class Boot extends Command
{
    protected $signature = 'app:boot';
    protected $description = 'Command description';
    public function handle()
    {
        foreach(Film::all() as $film)
        {
            $film->daily_gain = 0;
            $film->save();
        }
        foreach(Hall::all() as $hall)
        {
            $hall->sold_base_seats = 0;
            $hall->sold_vip_seats = 0;
            $hall->save();
        }
    }
}
