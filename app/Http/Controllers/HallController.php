<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use App\Models\Hall;
use App\Repository\HallRepositoryInterface;
use Spatie\FlareClient\Api;

class HallController extends Controller
{
    private $hallRepository;
    public function __construct(HallRepositoryInterface $hallRepository)
    {
        $this->hallRepository = $hallRepository;
    }

    public function show()
    {
        $halls = $this->hallRepository->all();
        if(is_null($halls))
            return response()->json([
                "code" => 404,
                "message"=> "Empty table halls"
            ], 404)->header('Content-Type', 'application/json');
        return response($halls)->header("Content-Type", "application/json");
    }

    public function getHall(int $id)
    {
        $hall = $this->hallRepository->getHall($id);
        if(!(is_null($hall)))
            return response($hall)->header("Content-Type", "application/json");
        else
            return response()->json([
                "code"=> 404,
                "message"=> "Not a valid hall"
            ], 404)->header('Content-Type', 'application/json');
    }
    public function deleteHall(int $id)
    {
        if($this->hallRepository->deleteHall($id))
            return response()->json(["status"=> "completed"], 200)->header('Content-Type', 'application/json');
        return response()->json([
            "code"=> 404,
            "message"=> "Not a valid hall"
        ], 404)->header('Content-Type', 'application/json');
    }
    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $hall = $this->hallRepository->insert($obj);
        return response($hall, 201)->header('Content-Type', 'application/json');
    }

    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $hall = $this->hallRepository->put($obj);
        return response($hall, 201)->header('Content-Type', 'application/json');
    }

    public function getHallsNumber()
    {
        $number = $this->hallRepository->number();
        return response()->json(["number" => $number] ,200)->header('Content-Type', 'application/json');
    }
}
