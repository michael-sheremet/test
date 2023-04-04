<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected function getErrorResponse(int $code = 500, string $method = 'Something went wrong. Please try again later.')
    {
        return response()->json(['message'=>'Something went wrong. Please try again later'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
