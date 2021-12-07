<?php

namespace upload\Exceptions;

use ExceptionUpload;

class NotIsImage extends ExceptionUpload
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("Selecciono el typo imagen pero el archivo leido no es una imagen($type)", $code);
    }
}
