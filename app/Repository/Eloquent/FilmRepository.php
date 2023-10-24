<?php

namespace App\Repository\Eloquent;

use App\Helpers\ApiHelper;
use App\Models\Film;
use App\Repository\FilmRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

class FilmRepository extends BaseRepository implements FilmRepositoryInterface
{
    protected $model;
    public function __construct(Film $model)
    {
        $this->model = $model;
    }
    public function all(): Collection|null
    {
        return $this->model::all();
    }
    public function getFilm(string|int $param): Film|null
    {
        if(is_numeric($param))
            return $this->model::where('remote_id', $param)->first();
        else
            return $this->model::where('title', ApiHelper::replaceString($param))->first();
    }
    public function delete(int|string $param): bool|null
    {
        if(is_numeric($param))
            return $this->model::where('remote_id', $param)->delete();
        else
            return $this->model::where('title', ApiHelper::replaceString($param))->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Film();
        foreach($attributes as $key => $value)
        {
            if($key == "id")
            {
                $this->model->remote_id = $value;
                continue;
            }
            if(!(is_null($value)))
                $this->model->{$key} = $value;
        }
        $this->model->save();
    }

    public function put(stdClass $attributes): void
    {
        $this->model = new Film();
        $this->model = Film::where('title', $attributes->title)->first();
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

    public function comingSoon(): Collection|null
    {
        return $this->model::where('status', 'incoming')->get();
    }
    public function avaiable(): Collection|null
    {
        return $this->model::where('status', 'avaiable')->get();
    }
    public function expired(): Collection|null
    {
        return $this->model::where('status', 'expired')->get();
    }
}


