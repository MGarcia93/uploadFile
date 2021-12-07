<?php

namespace upload\Exceptions;

use ExceptionUpload;

class NotIsZip extends ExceptionUpload
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("Selecciono el formato zip pero el archivo leido no es un zip($type)", $code);
    }
}
