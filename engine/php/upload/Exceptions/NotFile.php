<?php

namespace upload\Exceptions;



class NotFile extends ExceptionUpload
{
    function __construct()
    {
        parent::__construct("No se recibieron archivos", 200);
    }
}
