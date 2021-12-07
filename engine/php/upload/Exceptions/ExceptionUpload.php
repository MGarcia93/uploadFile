<?php

use upload\Exceptions;

class ExceptionUpload extends \Exception
{

    function __construct($error, $code = 404)
    {
        parent::__construct($error, 0);
        http_response_code($code);
        echo json_encode([
            "error" => $error,
            "code" => $code
        ]);
    }
}
