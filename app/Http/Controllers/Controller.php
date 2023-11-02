<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;


/**
 * @OA\Info(title="My First API", version="0.1")
 *
 * @OA\Get(
 *      path="/profiles",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *      ),
 *     @OA\PathItem (
 *     ),
 * )
 */

class Controller extends BaseController
{

}
