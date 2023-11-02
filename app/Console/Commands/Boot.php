<?php

namespace App\Console\Commands;

use App\Http\Controllers\BookingController;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
                $ticket = Ticket::where('film_id', $film->id)->first();
                if(!(is_null($ticket)))
                    DB::table('film_report_monthly')->insert([
                        'film_id' => $film->id,
                        'monthly_gain' => $film->monthly_gain,
                        'tickets_sold' => $ticket->monthly_sold,
                        'date' => date('Y-m-d')
                    ]);
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
                $ticket = Ticket::where('film_id', $film->id)->first();
                if(!(is_null($ticket)))
                    DB::table('film_report_weekly')->insert([
                        'film_id' => $film->id,
                        'weekly_gain' => $film->daily_gain,
                        'tickets_sold' => $ticket->weekly_sold,
                        'date' => date('Y-m-d')
                    ]);
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
            $ticket = Ticket::where('film_id', $film->id)->first();
            if(!(is_null($ticket)))
                DB::table('film_report_daily')->insert([
                    'film_id' => $film->id,
                    'daily_gain' => $film->daily_gain,
                    'tickets_sold' => $ticket->daily_sold,
                    'date' => date('Y-m-d')
                ]);
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
