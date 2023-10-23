<?php

namespace App\Repository\Eloquent;

use App\Models\Hall;
use App\Repository\HallRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class HallRepository extends BaseRepository implements HallRepositoryInterface
{
    protected $model;
    public function __construct(Hall $model)
    {
        $this->model = $model;
    }
    public function all(): Collection
    {
        return $this->model::all();
    }
    public function get(int $id): Hall
    {
        return $this->model::where('remote_id', $id)->first();
    }
    public function delete(int $id): void
    {
        $this->model::where('remote_id', $id)->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Hall();
        $this->model->name = $attributes->name;
        if(!(is_null($attributes->seats)))
            $this->model->seats = $attributes->seats;
        if(!(is_null($attributes->vip_seats)))
            $this->model->vip_seats = $attributes->vip_seats;
        $this->model->film_id = $attributes->film_id;
        $this->model->remote_id = $attributes->remote_id;
        $this->model->save();
    }

    public function put(stdClass $attributes): void
    {
        $this->model = new Hall();
        $this->model = Hall::where('name', $attributes->title)->first();
        if(is_null($this->model))
            $this->insert($attributes);
        else
            foreach($attributes as $key => $value)
            {
                if($key == "id")
                {
                    $this->model->remote_id = $value;
                    continue;
                }
                $this->model->{$key} = $value;
                $this->model->save();
            }
    }

    public function number(): int
    {
        return $this->model->all()->count();
    }
}
