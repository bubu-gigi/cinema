<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use stdClass;

class ApiHelper
{
    public static function toStdClass(Request $request): stdClass
    {
        $json = $request->json()->all();
        $obj = json_decode(json_encode($json));
        return (object) $obj;
    }

    public static function replaceString(string $string): string
    {
        return str_replace('-', ' ', $string);
    }
}
