<?php

namespace upload\Exceptions;

use Exceptions\Handle;



class NotFile extends Handle
{
    function __construct()
    {
        parent::__construct("", "No se recibieron archivos", 200);
    }
}
