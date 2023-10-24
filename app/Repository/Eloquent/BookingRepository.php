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
        $hall = Hall::where('name', $attributes->hall)->first();
        $film = Film::where('title', $attributes->title)->first();
        $ticket = Ticket::where('film_title', $attributes->title)->first();
        if(is_null($hall))
            return "Errore nella procedura di booking";
        if($vip)
        {
            if($hall->sold_vip_seats != $hall->vip_seats)
            {
                $booking = new Booking();
                $booking->film_title = $film->title;
                $booking->hall_name = $hall->name;
                $booking->is_vip = true;
                $booking->save();
                $hall->increment('sold_vip_seats', 1);
                $hall->save();
                $increase = (float) ($ticket->price * $ticket->percentage_increase) / 100;
                $vipEarn = (float) $ticket->price + $increase;
                $film->increment('daily_gain', $vipEarn);
                $film->increment('tot_gain', $ticket->price);
                $film->save();
                return true;
            }
            return false;
        }
        else
        {
            if($hall->sold_base_seats != $hall->base_seats)
            {
                $booking = new Booking();
                $booking->film_title = $film->title;
                $booking->hall_name = $hall->name;
                $booking->is_vip = false;
                $booking->save();
                $hall->increment('sold_base_seats', 1);
                $hall->save();
                $film->increment('daily_gain', $ticket->price);
                $film->increment('tot_gain', $ticket->price);
                $film->save();
                return true;
            }
            return false;
        }
    }
}
