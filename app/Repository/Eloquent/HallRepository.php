<?php

namespace App\Repository\Eloquent;

use App\Helpers\ApiHelper;
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
    public function getHall(int $id): Hall|null
    {
        return $this->model::where('id', $id)->first();
    }
    public function deleteHall(int $id): bool|null
    {
        return $this->model::where('id', $id)->delete();
    }
    public function insert(stdClass $attributes): Hall
    {
        $this->model = new Hall();
        foreach($attributes as $key => $value)
            $this->model->$key = $value;
        $this->model->save();
        return $this->model;
    }

    public function put(stdClass $attributes): Hall
    {
        $this->model = new Hall();
        $flag = false;
        if(isset($attributes->id))
        {
            $flag = true;
            $this->model = Hall::where('id', $attributes->id)->first();
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

    public function number(): int
    {
        return $this->model->all()->count();
    }
}
