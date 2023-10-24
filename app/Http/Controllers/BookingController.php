<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use App\Repository\BookingRepositoryInterface;
use App\Repository\FilmRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    private $filmRepository;
    private $bookingRepository;
    public static int $daily_sales = 0;
    public function __construct(BookingRepositoryInterface $bookingRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->filmRepository = $filmRepository;
    }
    public function getFilmsAvaiable()
    {
        $films = $this->filmRepository->avaiable();
        if(!(is_null($films)))
            foreach($films as $film)
                echo "Film's title is: " . $film->title . "<br>";
    }
    public function getFilmsIncoming()
    {
        $films = $this->filmRepository->comingSoon();
        if(!(is_null($films)))
            foreach($films as $film)
                echo "Film's title is: " . $film->title . "<br>";

    }
    public function bookingFilm(Request $request, $vip = null)
    {
        $obj = ApiHelper::toStdClass($request);
        $result = $this->bookingRepository->bookingFilm($obj, $vip);
        if($result)
        {
            self::$daily_sales++;
            return response("Prenotazione effettuata con successo! Buona visione.", 201);
        }
        else if(!($result))
            return response("Ci scusiamo, ma non è stato possibile effettuare la prenotazione", 400);
        else
            return response(500);
    }
    public static function getDailySale()
    {
        return self::$daily_sales;
    }
}
