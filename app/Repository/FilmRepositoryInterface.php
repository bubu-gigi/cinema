<?php

namespace App\Repository;

use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface FilmRepositoryInterface
{
    public function all(): Collection;
    public function get(int $id): Film;
    public function delete(int $id): void;
    public function insert(stdClass $attributes): void;
    public function put(stdClass $attributes): void;
    public function comingSoon(): Collection|null;
    public function avaiable(): Collection|null;
    public function expired(): Collection|null;
    public function getIdByTitle(string $title): Film;
}
