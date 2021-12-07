<?php

namespace upload\Exceptions;


class NotIsPdf extends ExceptionUpload
{
    function __construct($type, $code = 400)
    {
        parent::__construct("Selecciono el formato pdf pero el archivo leido no es un pdf, formato recibido: $type", $code);
    }
}
