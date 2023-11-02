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
    public function __construct(BookingRepositoryInterface $bookingRepository, FilmRepositoryInterface $filmRepository)
    {
        $this->bookingRepository = $bookingRepository;
        $this->filmRepository = $filmRepository;
    }
    public function bookingFilm(Request $request, $vip = null)
    {
        $obj = ApiHelper::toStdClass($request);
        $type = "base";

        if($vip)
            $type = "vip";
        $result = $this->bookingRepository->bookingFilm($obj, $vip);

        if($result)
            return response()->json([
                "status" => "created",
                "type" => $type,
            ], 201);
        else if(!($result))
            return response()->json([
                "status" => "failed",
                "message" => "seats sold out"
            ], 400);
        else
            return response()->json([
                "code" => 400,
                "message" => $result
            ], 400);
    }
}
