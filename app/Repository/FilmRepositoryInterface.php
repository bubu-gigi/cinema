<?php

namespace App\Repository;

use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface FilmRepositoryInterface
{
    public function all(): Collection|null;
    public function getFilm(string|int $param): Film|null;
    public function delete(string|int $param): bool|null;
    public function insert(stdClass $attributes): void;
    public function put(stdClass $attributes): void;
    public function comingSoon(): Collection|null;
    public function avaiable(): Collection|null;
    public function expired(): Collection|null;
}
