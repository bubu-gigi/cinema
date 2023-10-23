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
        $halls =  $this->hallRepository->all();
        foreach( $halls as $hall )
            echo "Hall's name is: " . $hall->name . " and its id is: " . $hall->remote_id . "<br>";
    }

    public function get(int $id)
    {
        $hall = $this->hallRepository->get($id);
        echo "Hall's name is: " . $hall->name . " and its id is: " . $hall->remote_id . "<br>";
    }

    public function delete(int $id)
    {
        if($this->hallRepository->delete($id))
            echo "Hall deleted successfully!";
    }

    public function store(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->hallRepository->insert($obj);
    }

    public function update(Request $request)
    {
        $obj = ApiHelper::toStdClass($request);
        $this->hallRepository->put($obj);
    }

    public function getHallsNumber(): int
    {
        $number = $this->hallRepository->number();
        return $number;
    }
}
