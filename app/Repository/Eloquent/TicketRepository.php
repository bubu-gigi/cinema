<?php

namespace App\Repository\Eloquent;

use App\Helpers\ApiHelper;
use App\Models\Film;
use App\Models\Hall;
use App\Models\Ticket;
use App\Repository\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class TicketRepository extends BaseRepository implements TicketRepositoryInterface
{
    protected $model;
    public function __construct(Ticket $model)
    {
        $this->model = $model;
    }
    public function all(): Collection
    {
        return $this->model::all();
    }
    public function getTicket(int $id): Ticket|null
    {
        return $this->model::where('id', $id)->first();
    }

    public function getTicketByFilmId(int $id): Ticket|null
    {
        return $this->model::where('film_id', $id)->first();
    }
    public function insert(stdClass $attributes): Ticket
    {
        $this->model = new Ticket();
        foreach($attributes as $key => $value)
            $this->model->$key = $value;
        $this->model->save();
        return $this->model;
    }

    public function put(stdClass $attributes): Ticket
    {
        $this->model = new Ticket();
        $flag = false;
        if(isset($attributes->id))
        {
            $this->model = Ticket::where('id', $attributes->id)->first();
            $flag = true;
        }
        if(!($flag))
        {
            $this->insert($attributes);
            return $this->model;
        }
        else
        {
            foreach($attributes as $key => $value)
                $this->model->$key = $value;
            $this->model->save();
            return $this->model;
        }
    }

    public function delete(int $id): bool|null
    {
        return $this->model::where('id', $id)->delete();
    }

    public function changePrice(stdClass $attributes): Ticket|null
    {
        $this->model = new Ticket();
        if(isset($attributes->id))
            $this->model = $this->model::where('id', $attributes->id)->first();
        if(is_null($this->model))
            return null;
        $this->model->price = $attributes->price;
        $this->model->save();
        return $this->model;
    }

    public function calculateCollection(Film $film): float|false
    {
        $this->model = $this->getTicket($film->id);
        $hall = Hall::where("id", $this->model->hall_id)->first();
        $baseEarn = (float) ($hall->sold_base_seats * $this->model->price);
        $increase = (float) ($this->model->price * $this->model->percentage_increase) / 100;
        $vipEarn = (float) ($this->model->price + $increase * $hall->sold_vip_seats);
        $earn = $baseEarn + $vipEarn;
        return $earn;
    }
}
