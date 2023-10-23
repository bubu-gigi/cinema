<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Ticket;
use App\Repository\FilmRepositoryInterface;
use App\Repository\TicketRepositoryInterface;

class FilmController extends Controller
{
    private $filmRepository;
    private $ticketRepository;
    public function __construct(FilmRepositoryInterface $filmRepository, TicketRepositoryInterface $ticketRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->ticketRepository = $ticketRepository;
    }
    public function show()
    {
        $films = $this->filmRepository->all();
        foreach($films as $film)
            echo "Film's id is: " . $film->remote_id . "and the title is: " . $film->title;
    }

    public function get(int $id)
    {
        $film = $this->filmRepository->get($id);
        echo "Film's id is: " . $film->remote_id . " and the title is: " . $film->title;
    }

    public function delete(int $id)
    {
        if($this->filmRepository->delete($id))
            echo "Film deleted successfully!";
    }
    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->filmRepository->insert($obj);
    }
    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->filmRepository->put($obj);
    }
    public function comingSoon()
    {
        $films = $this->filmRepository->comingSoon();
        foreach($films as $film)
            echo "Film's title is: " . $film->title . " and it will be realeased on: " . $film->release_date . "<br>";
    }
    public function avaiable()
    {
        $films = $this->filmRepository->avaiable();
        foreach($films as $film)
            echo "Film's title is: " . $film->title . "<br>";
    }

    public function expired()
    {
        $films = $this->filmRepository->expired();
        foreach($films as $film)
            echo "Film's title is: " . $film->title . "<br>";
    }

    public function getPellicola(int $id)
    {
        $film = $this->filmRepository->get($id);
        echo "Film's title is: " . $film->title . " and it has: " . $film->pellicole . "left <br>";
    }

    public function getIdByTitle(string $name)
    {
        $film = $this->filmRepository->getIdByTitle($name);
        echo $film->remote_id;
    }

    public function collection(int $id)
    {
        $film = $this->filmRepository->get($id);
        $collection = $this->ticketRepository->calculateCollection($film);
        return $collection;
    }
}
