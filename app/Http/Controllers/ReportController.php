<?php

namespace App\Http\Controllers;

use App\Repository\FilmRepositoryInterface;
use App\Repository\TicketRepositoryInterface;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $filmRepository;
    private $ticketRepository;

    public function __construct(FilmRepositoryInterface $filmRepository, TicketRepositoryInterface $ticketRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function dailyReport(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        $ticket = $this->ticketRepository->getTicketByFilmId($id);
        if(is_null($film))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
        return response ()->json([
            "id" => $film->id,
            "title" => $film->title,
            "dailyGain" => $film->daily_gain,
            "soldDayTickets" => $ticket->daily_sold
        ], 200);
    }

    public function weeklyReport(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        $ticket = $this->ticketRepository->getTicketByFilmId($id);
        if(is_null($film))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
        return response ()->json([
            "id" => $film->id,
            "title" => $film->title,
            "weekGain" => $film->weekly_gain,
            "soldWeekTickets" => $ticket->weekly_sold
        ], 200);
    }

    public function monthlyReport(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        $ticket = $this->ticketRepository->getTicketByFilmId($id);
        if(is_null($film))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
        return response ()->json([
            "id" => $film->id,
            "title" => $film->title,
            "weekGain" => $film->monthly_gain,
            "soldMonthTickets" => $ticket->monthly_sold
        ], 200);
    }
}
