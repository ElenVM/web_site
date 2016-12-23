<?php

namespace App\Exceptions;

use App\Http\Response;

class HttpResponseException extends \Exception
{
    public $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }
}