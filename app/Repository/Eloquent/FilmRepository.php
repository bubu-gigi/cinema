<?php

namespace App\Repository\Eloquent;

use App\Models\Film;
use App\Repository\FilmRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class FilmRepository extends BaseRepository implements FilmRepositoryInterface
{
    protected $model;
    public function __construct(Film $model)
    {
        $this->model = $model;
    }
    public function all(): Collection
    {
        return $this->model::all();
    }
    public function get(int $id): Film
    {
        return $this->model::where('remote_id', $id)->first();
    }
    public function delete(int $id): void
    {
        $this->model::where('remote_id', $id)->delete();
    }
    public function insert(stdClass $attributes): void
    {
        $this->model = new Film();
        $this->model->title = $attributes->title;
        if(!(is_null($attributes->description)))
            $this->model->description = $attributes->description;
        if(!(is_null($attributes->director)))
            $this->model->director = $attributes->director;
        if(!(is_null($attributes->producer)))
            $this->model->producer = $attributes->producer;
        if(!(is_null($attributes->release_date)))
            $this->model->release_date = $attributes->release_date;
        $this->model->remote_id = $attributes->id;
        if(!(is_null($attributes->time)))
            $this->model->time = $attributes->time;
        if(!(is_null($attributes->tickets)))
            $this->model->tickets = $attributes->tickets;
        if(!(is_null($attributes->pellicole)))
            $this->model->pellicole = $attributes->pellicole;
        $this->model->save();
    }

    public function put(stdClass $attributes): void
    {
        $this->model = new Film();
        $this->model = Film::where('title', $attributes->title)->first();
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

    public function comingSoon(): Collection
    {
        return $this->model::where('status', 'incoming')->get();
    }
    public function avaiable(): Collection
    {
        return $this->model::where('status', 'avaiable')->get();
    }
    public function expired(): Collection
    {
        return $this->model::where('status', 'expired')->get();
    }

    public function getIdByTitle(string $title): Film
    {
        return $this->model::where('title', $title)->first();
    }
}


