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
    public function getTicket(string|int $param): Ticket|null
    {
        if(is_numeric($param))
            return $this->model::where('film_id', $param)->first();
        else
            return $this->model::where('film_title', ApiHelper::replaceString($param))->first();
    }
    public function delete(int $id): void
    {
        $this->model::where('remote_id', $id)->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Ticket();
        foreach($attributes as $key => $value)
        {
            if($key == "id")
                {
                    $this->model->remote_id = $value;
                    continue;
                }
            $this->model->{$key} = $value;
        }
        $this->model->save();
    }

    public function put(stdClass $attributes): void
    {
        $this->model = new Ticket();
        $this->model = Ticket::where('film_id', $attributes->film_id)->first();
        if(is_null($this->model))
            $this->insert($attributes);
        else
        {
            foreach($attributes as $key => $value)
            {
                if($key == "id")
                {
                    $this->model->remote_id = $value;
                    continue;
                }
                $this->model->{$key} = $value;
            }
            $this->model->save();
        }
    }

    public function deleteTicket(string|int $param): bool|null
    {
        if(is_numeric($param))
            return $this->model::where('film_id', $param)->delete();
        else
            return $this->model::where('film_title', ApiHelper::replaceString($param))->delete();
    }

    public function changePrice(stdClass $attributes): void
    {
        $this->model = $this->model::where('film_title', ApiHelper::replaceString($attributes->film_title))->first();
        $this->model->price = $attributes->price;
        $this->model->save();
    }

    public function calculateCollection(Film $film): float
    {
        $this->model = $this->getTicket($film->remote_id);
        $hall = Hall::where('remote_id', $this->model->hall_id)->first();
        $baseEarn = (float) ($hall->sold_base_seats * $this->model->price);
        $increase = (float) ($this->model->price * $this->model->percentage_increase) / 100;
        $vipEarn = (float) (($this->model->price + $increase) * $hall->sold_vip_seats);
        $earn = $baseEarn + $vipEarn;
        return $earn;
    }
}
