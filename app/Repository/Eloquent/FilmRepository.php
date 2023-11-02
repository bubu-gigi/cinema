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
    public function getFilm(int $id): Film|null
    {
        return $this->model::where('id', $id)->first();
    }
    public function delete(int $id): bool|null
    {
        return $this->model::where('id', $id)->delete();
    }
    public function insert(stdClass $attributes): Film
    {
        $this->model = new Film();
        foreach($attributes as $key => $value)
            $this->model->$key = $value;
        $this->model->save();
        return $this->model;
    }

    public function put(stdClass $attributes): Film
    {
        $this->model = new Film();
        $flag = false;
        if(isset($attributes->id))
        {
            $this->model = Film::where('id', $attributes->id)->first();
            $flag = true;
        }
        if(!($flag))
        {
            $film = $this->insert($attributes);
            return $film;
        }
        else
        {
            foreach($attributes as $key => $value)
                $this->model->{$key} = $value;
            $this->model->save();
            return $this->model;
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


