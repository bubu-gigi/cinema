<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Repository\FilmRepositoryInterface;
class FilmController extends Controller
{
    private $filmRepository;
    public function __construct(FilmRepositoryInterface $filmRepository)
    {
        $this->filmRepository = $filmRepository;
    }
    public function show()
    {
        $films = $this->filmRepository->all();
        if(is_null($films))
            return response()->json([
                "code" => 404,
                "message" => "Empty films table"
            ], 404)->header('Content-Type', 'application/json');
        return response($films)->header("Content-Type", "application/json");
    }
    public function getFilm(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        if(!(is_null($film)))
            return response($film)->header("Content-Type", "application/json");
        else
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
    }
    public function deleteFilm(int $id)
    {
        $film = $this->filmRepository->delete($id);
        if(!(is_null($film)))
            return response()->json([
                "status" => "completed"
            ], 200)->header('Content-Type', 'application/json');
        else
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $film = $this->filmRepository->insert($obj);
        return response($film, 201)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $film = $this->filmRepository->put($obj);
        return response($film, 201)->header('Content-Type', 'application/json');
    }

    public function comingSoon()
    {
        $films = $this->filmRepository->comingSoon();
        if(is_null($films))
        return response()->json([
            "code" => 204,
            "message" => "Not films coming soon"
        ], 204)->header('Content-Type', 'application/json');
        else
            return response($films, 200)->header('Content-Type', 'application/json');
    }
    public function avaiable()
    {
        $films = $this->filmRepository->avaiable();
        if(is_null($films))
            return response()->json([
                "code" => 204,
                "message" => "Not films avaiable"
            ], 204)->header('Content-Type', 'application/json');
        else
            return response($films, 200)->header('Content-Type', 'application/json');
    }

    public function expired()
    {
        $films = $this->filmRepository->expired();
        if(is_null($films))
            return response()->json([
                "code" => 204,
                "message" => "Not films expired"
            ], 204)->header('Content-Type', 'application/json');
        else
            return response($films, 200)->header('Content-Type', 'application/json');
    }
    public function getNumeroPellicole(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        if(is_null($film))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
        else
            return response()->json([
                "Title" => $film->title,
                "Id" => $film->id,
                "Films" => $film->pellicole
            ], 200)->header('Content-Type', 'application/json');
    }
    public function getCollection(int $id)
    {
        $film = $this->filmRepository->getFilm($id);
        if(is_null($film))
            return response()->json([
                "code" => 404,
                "message" => "Not an existing film"
            ], 404)->header('Content-Type', 'application/json');
        else
            return response()->json([
                "Title" => $film->title,
                "Id" => $film->id,
                "Collection" => $film->tot_gain
            ], 200)->header('Content-Type', 'application/json');
    }
}
