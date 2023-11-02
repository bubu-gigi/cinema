<?php

namespace App\Repository;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface HallRepositoryInterface
{
    public function all(): Collection;
    public function getHall(int $param): Hall|null;
    public function deleteHall(int $param): bool|null;
    public function insert(stdClass $attributes): Hall;
    public function put(stdClass $attributes): Hall;
    public function number(): int;
}
