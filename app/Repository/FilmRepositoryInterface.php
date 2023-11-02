<?php

namespace App\Repository;

use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface FilmRepositoryInterface
{
    public function all(): Collection|null;
    public function getFilm(int $id): Film|null;
    public function delete(int $id): bool|null;
    public function insert(stdClass $attributes): Film;
    public function put(stdClass $attributes): Film;
    public function comingSoon(): Collection|null;
    public function avaiable(): Collection|null;
    public function expired(): Collection|null;
}
 