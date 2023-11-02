<?php

namespace App\Console\Commands;

use App\Http\Controllers\BookingController;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Ticket;
use Illuminate\Console\Command;

class Boot extends Command
{
    protected $signature = 'app:boot';
    protected $description = 'Reebot';
    public function handle()
    {
        if (date('d') == 01)
        {
            foreach(Film::all() as $film)
            {
                $film->monthly_gain = 0;
                $film->save();
            }
            foreach(Ticket::all() as $ticket)
            {
                $ticket->monthly_sold = 0;
                $ticket->save();
            }
        }
        if(date('l') == "Monday")
        {
            foreach(Film::all() as $film)
            {
                $film->weekly_gain = 0;
                $film->save();
            }
            foreach(Ticket::all() as $ticket)
            {
                $ticket->weekly_sold = 0;
                $ticket->save();
            }
        }

        foreach(Film::all() as $film)
        {
            $film->daily_gain = 0;
            $film->save();
        }

        foreach(Ticket::all() as $ticket)
        {
            $ticket->daily_sold = 0;
            $ticket->save();
        }
        foreach(Hall::all() as $hall)
        {
            $hall->sold_base_seats = 0;
            $hall->sold_vip_seats = 0;
            $hall->save();
        }
    }
}
