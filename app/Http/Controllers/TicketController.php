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
        return response($tickets, 200)->header('Content-Type', 'application/json');
    }

    public function getTicket(int $filmId)
    {
        $ticket = $this->ticketRepository->getTicket($filmId);
        if(is_null($ticket))
            return response()->json([
                "code" => 404,
                "message" => "Not ticket found"
            ], 404)->header('Content-Type', 'application/json');
        else
            return response($ticket, 200)->header('Content-Type', 'application/json');
    }
    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $ticket = $this->ticketRepository->insert($obj);
        return response($ticket, 201)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $ticket = $this->ticketRepository->put($obj);
        return response($ticket, 201)->header('Content-Type', 'application/json');
    }

    public function updatePrice(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $ticket = $this->ticketRepository->changePrice($obj);
        if(is_null($ticket))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing ticket"
            ], 404)->header('Content-Type', 'application/json');
        return response($ticket, 201)->header('Content-Type', 'application/json');
    }
    public function deleteTicket(int $filmId)
    {
        $ticket = $this->ticketRepository->delete($filmId);
        if(!(is_null($ticket)))
            return response()->json([
                "status" => "completed"
            ])->header('Content-Type', 'application/json');
        else
            return response()->json([
                "code" => 404,
                "message" => "Not an existing ticket"
            ], 404)->header('Content-Type', 'application/json');
    }
}
