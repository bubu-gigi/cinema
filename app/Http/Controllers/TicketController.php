<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Repository\TicketRepositoryInterface;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $ticketRepository;
    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function show()
    {
        $tickets = $this->ticketRepository->all();
        foreach($tickets as $ticket)
            echo "Ticket's id is: " . $ticket->remote_id . ", the hall id is: " . $ticket->hall_id . ", the film id is: " . $ticket->film_id . " and the film title is: " . $ticket->film_title;
    }

    public function getTicketByFilmId(int $filmId)
    {
        $ticket = $this->ticketRepository->getTicket($filmId);
        if(is_null($ticket))
            echo "Error";
        else
            echo "Ticket's price for the film is: " . $ticket->price;
    }

    public function getTicketByNameId(int $filmId)
    {
        $ticket = $this->ticketRepository->getTicket($filmId);
        if(is_null($ticket))
            echo "Error";
        else
            echo "Ticket's price for the film is: " . $ticket->price;
    }

    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->ticketRepository->insert($obj);
    }

    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->ticketRepository->put($obj);
    }

    public function updatePrice(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->ticketRepository->changePrice($obj);
    }
}
