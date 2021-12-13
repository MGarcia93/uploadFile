<?php

namespace Exceptions;

class Handle extends \Exception
{

    function __construct($name, $message, $code = 404)
    {
        parent::__construct($message, $code);
        http_response_code($code);
        echo json_encode([
            "ERROR" => $name,
            "message" => $message,
            "status" => $code
        ]);
    }
}
