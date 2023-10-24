<?php

namespace App\Repository;

use App\Models\Hall;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface HallRepositoryInterface
{
    public function all(): Collection;
    public function getHall(string|int $param): Hall|null;
    public function deleteHall(string|int $param): bool|null;
    public function insert(stdClass $attributes): void;
    public function put(stdClass $attributes): void;
    public function number(): int;
}
