<?php

namespace App\Repository\Eloquent;

use App\Models\Booking;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Ticket;
use App\Repository\BookingRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class BookingRepository extends BaseRepository implements BookingRepositoryInterface
{
    protected $model;
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }

    public function bookingFilm(stdClass $attributes, $vip): bool|string
    {
        $ticket = Ticket::where("film_id", $attributes->id)->first();
        $hall = Hall::where('id', $ticket->hall_id)->first();
        $film = Film::where('id', $attributes->film_id)->first();
        if(is_null($hall))
            return "Errore nella procedura di booking: hall not found";
        if(is_null($film))
            return "Errore nella procedura di booking: film not found";
        if(is_null($ticket))
            return "Errore nella procedura di booking: ticket not found";
        if($vip)
        {
            if($hall->sold_vip_seats != $hall->vip_seats)
            {
                $booking = new Booking();
                $booking->film_id = $film->id;
                $booking->hall_id = $hall->id;
                $booking->is_vip = true;
                $booking->save();

                $hall->increment('sold_vip_seats', 1);
                $hall->save();

                $increase = (float) ($ticket->price * $ticket->percentage_increase) / 100;
                $vipEarn = (float) $ticket->price + $increase;

                $film->increment('daily_gain', $vipEarn);
                $film->increment('weekly_gain', $vipEarn);
                $film->increment('monthly_gain', $vipEarn);
                $film->increment('tot_gain', $vipEarn);
                $film->save();

                $ticket->increment('daily_sold', 1);
                $ticket->increment('weekly_sold', 1);
                $ticket->increment('monthly_sold', 1);
                $ticket->save();

                return true;
            }
            return false;
        }
        else
        {
            if($hall->sold_base_seats != $hall->base_seats)
            {
                $booking = new Booking();
                $booking->film_id = $film->id;
                $booking->hall_id = $hall->id;
                $booking->is_vip = true;
                $booking->save();

                $hall->increment('sold_base_seats', 1);
                $hall->save();

                $film->increment('daily_gain', $ticket->price);
                $film->increment('weekly_gain', $ticket->price);
                $film->increment('monthly_gain', $ticket->price);
                $film->increment('tot_gain', $ticket->price);
                $film->save();

                $ticket->increment('daily_sold', 1);
                $ticket->increment('weekly_sold', 1);
                $ticket->increment('monthly_sold', 1);
                $ticket->save();

                return true;
            }
            return false;
        }
    }
}
