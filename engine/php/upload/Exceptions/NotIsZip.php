<?php

namespace upload\Exceptions;

use Exceptions\Handle;



class NotIsZip extends Handle
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("FILE_INVALID", "Selecciono el formato zip pero el archivo leido no es un zip, formato recibido: $type", $code);
    }
}
