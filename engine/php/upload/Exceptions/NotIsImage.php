<?php

namespace upload\Exceptions;

use Exceptions\Handle;

class NotIsImage extends Handle
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("FILE_INVALID", "Selecciono el typo imagen pero el archivo leido no es una imagen, formato recibido: $type", $code);
    }
}
