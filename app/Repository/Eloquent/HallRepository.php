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
    public function getHall(string|int $param): Hall|null
    {
        if(is_numeric($param))
            return $this->model::where('remote_id', $param)->first();
        else
            return $this->model::where('name', ApiHelper::replaceString($param))->first();
    }
    public function deleteHall(string|int $param): bool|null
    {
        if(is_numeric($param))
            return $this->model::where('remote_id', $param)->delete();
        else
            return $this->model::where('name', ApiHelper::replaceString($param))->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Hall();
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
        $this->model = new Hall();
        $this->model = Hall::where('name', $attributes->name)->first();
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

    public function number(): int
    {
        return $this->model->all()->count();
    }
}
