<?php

namespace App\Repository;

use App\Models\Film;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface BookingRepositoryInterface
{
    public function bookingFilm(stdClass $attributes, $vip): bool|string;
}
