<?php

namespace upload\Exceptions;

use Exceptions\Handle;

class NotIsPdf extends Handle
{
    function __construct($type, $code = 400)
    {
        parent::__construct("FILE_INVALID", "Selecciono el formato pdf pero el archivo leido no es un pdf, formato recibido: $type", $code);
    }
}
