<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Repository\FilmRepositoryInterface;
use App\Repository\TicketRepositoryInterface;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketRepository;
    private $filmRepository;
    public function __construct(TicketRepositoryInterface $ticketRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->filmRepository = $filmRepository;
    }

    public function show()
    {
        $tickets = $this->ticketRepository->all();
        foreach($tickets as $ticket)
            echo "Ticket's id is: " . $ticket->remote_id . ", the film id is: " . $ticket->film_id . " and the film name is: " . $this->filmRepository->get($ticket->film_id)->title;
    }

    public function get(string $title)
    {
        $titleReplaced = ApiHelper::replaceString($title);
        $film = $this->filmRepository->getIdByTitle($titleReplaced);
        $ticket = $this->ticketRepository->getTicket($film->remote_id);
        echo "Ticket's price for the film: " . $titleReplaced . " is: " . $ticket->price;
    }

}
