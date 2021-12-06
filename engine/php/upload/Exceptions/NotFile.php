<?php

namespace upload\Exceptions;

use ExceptionUpload;

class NotFile extends ExceptionUpload
{
    function __construct()
    {
        parent::__construct("No se recibieron archivos", 200);
    }
}
