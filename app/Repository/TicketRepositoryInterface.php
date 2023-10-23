<?php

namespace App\Repository;

use App\Models\Film;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface TicketRepositoryInterface
{
    public function all(): Collection;
    public function calculateCollection(Film $film): float;
    public function getTicket(int $id): Ticket;
}
