<?php

namespace App\Repository\Eloquent;

use App\Models\Film;
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
    public function get(int $id): Ticket
    {
        return $this->model::where('remote_id', $id)->first();
    }
    public function getTicketByFilmId(int $id): Ticket
    {
        return $this->model::where('film_id', $id)->first();
    }
    public function delete(int $id): void
    {
        $this->model::where('remote_id', $id)->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Ticket();
        $this->model->price = $attributes->price;
        if(!(is_null($attributes->base_amount)))
            $this->model->base_amount = $attributes->base_amount;
        if(!(is_null($attributes->initial_base_amount)))
            $this->model->initial_base_amount = $attributes->initial_base_amount;
        if(!(is_null($attributes->vip_amount)))
            $this->model->vip_amount = $attributes->vip_amount;
        if(!(is_null($attributes->initial_vip_amount)))
            $this->model->initial_vip_amount = $attributes->initial_vip_amount;
        if(!(is_null($attributes->percentage_increase)))
            $this->model->percentage_increase = $attributes->percentage_increase;
        $this->model->film_id = $attributes->film_id;
        $this->model->remote_id = $attributes->remote_id;
        $this->model->save();
    }

    public function put(stdClass $attributes): void
    {
        $this->model = new Ticket();
        $this->model = Ticket::where('film_id', $attributes->film_id)->first();
        if(is_null($this->model))
            $this->insert($attributes);
        else
            foreach($attributes as $key => $value)
            {
                $this->model->{$key} = $value;
                $this->model->save();
            }
    }

    public function calculateCollection(Film $film): float
    {
        $this->model = $this->getTicketByFilmId($film->remote_id);
        $diffBaseTickets = $this->model->initial_base_amount - $this->model->base_amount;
        $diffVipTickets = $this->model->initial_vip_amount - $this->model->vip_amount;
        $baseEarn = (float) ($diffBaseTickets * $this->model->price);
        $increase = (float) ($this->model->price * $this->model->percentage_increase) / 100;
        $vipEarn = (float) ($increase * $diffVipTickets);
        $earn = $baseEarn + $vipEarn;
        return $earn;
    }

    public function getTicket(int $id): Ticket
    {
        return $this->model->where('film_id', $id)->first();
    }
}
