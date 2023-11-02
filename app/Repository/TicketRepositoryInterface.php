<?php

namespace App\Repository;

use App\Models\Film;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use stdClass;

interface TicketRepositoryInterface
{
    public function all(): Collection;
    public function calculateCollection(Film $film): float|false;
    public function getTicket(int $id): Ticket|null;
    public function getTicketByFilmId(int $id): Ticket|null;
    public function insert(stdClass $attributes): Ticket;
    public function put(stdClass $attributes): Ticket;
    public function delete(int $id): bool|null;
    public function changePrice(stdClass $attributes): Ticket|null;
}
