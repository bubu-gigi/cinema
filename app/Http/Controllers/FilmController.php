<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Film;
use App\Models\Ticket;
use App\Repository\FilmRepositoryInterface;
use App\Repository\TicketRepositoryInterface;


#Posso mandare a schermo qualsiasi dato mi interessa, quello che ho deciso di mandare è solo per verifica che tutto funzioni correttamente
class FilmController extends Controller
{
    private $filmRepository;
    private $ticketRepository;
    public function __construct(FilmRepositoryInterface $filmRepository, TicketRepositoryInterface $ticketRepository)
    {
        $this->filmRepository = $filmRepository;
        $this->ticketRepository = $ticketRepository;
    }

    #caricamento di tutti i film mandando in output l'id_remoto e il titolo.
    public function show()
    {
        $films = $this->filmRepository->all();
        foreach($films as $film)
            echo "Film's id is: " . $film->remote_id . " and the title is: " . $film->title . "<br>";
    }

    #creare due funzioni singole, o farne solo una che opera in base a string oppure int parameter

    #caricamento di un film in base al suo id_remoto
    public function getFilmTitleById(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        if(!(is_null($film)))
            echo "Film's title is: " . $film->title;
        else
            echo "Film doesn't exist";
    }

    #caricamento di un film in base al suo titolo
    public function getFilmIdByTitle(string $title)
    {
        $title = ApiHelper::replaceString($title);
        $film = $this->filmRepository->getFilm($title);
        if(!(is_null($film)))
            echo "Film's id is: " . $film->remote_id;
        else
            echo "Film doesn't exist";
    }

    #rimuovo il film in base al suo id_remoto
    public function deleteFilmById(int $id)
    {
        if($this->filmRepository->delete($id))
            echo "Film deleted successfully!";
    }

    #rimuovo il film in base al suo titolo
    public function deleteFilmByTitle(string $title)
    {
        if($this->filmRepository->delete($title))
            echo "Film deleted successfully!";
    }

    #esegue la post(archiviazione) di un film. Obbligatori titolo e id
    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->filmRepository->insert($obj);
        $content = "New film created! " . "<br>" .
                    "His name is: " . $obj->title . "<br>" .
                    "his status is: " . $obj->status . "<br>" .
                    "his description is: " . $obj->description . "<br>" .
                    "his director is: " . $obj->director . "<br>" .
                    "his producer is: " . $obj->producer . "<br>" .
                    "his release_date is: " . $obj->release_date . "<br>" .
                    "his remote_id is: " . $obj->id . "<br>" .
                    "his time is: " . $obj->time . "<br>" .
                    "his films are: " . $obj->pellicole . "<br>";
        return response($content, 201)->header('Content-Type', 'application/json');
    }

    #esegue la put(modifica o archiviazione) di un film. Obbligatori titolo e id
    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->filmRepository->put($obj);
    }

    #manda in output i film in prossima uscita
    public function comingSoon()
    {
        $films = $this->filmRepository->comingSoon();
        if(is_null($films))
            echo "Empty";
        else
            foreach($films as $film)
                echo "Film's title is: " . $film->title . " and it will be realeased on: " . $film->release_date . "<br>";
    }
    public function avaiable()
    {
        $films = $this->filmRepository->avaiable();
        if(is_null($films))
            echo "Empty";
        else
            foreach($films as $film)
                echo "Film's title is: " . $film->title . "<br>";
    }

    public function expired()
    {
        $films = $this->filmRepository->expired();
        if(is_null($films))
            echo "Empty";
        else
            foreach($films as $film)
                echo "Film's title is: " . $film->title . "<br>";
    }

    public function getNumeroPellicoleById(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        if(is_null($film))
            echo "Film doesn't exist";
        else
            echo "Film's title is: " . $film->title . " and it has: " . $film->pellicole . "left <br>";
    }
    public function getNumeroPellicoleByTitle(int $title)
    {
        $film = $this->filmRepository->getFilm($title);
        if(is_null($film))
            echo "Film doesn't exist";
        else
            echo "Film's title is: " . $film->title . " and it has: " . $film->pellicole . "left <br>";
    }

    public function getCollection(string|int $param)
    {
        $film = $this->filmRepository->getFilm($param);
        return "Film's collection is: " . $film->tot_gain;
    }
}
