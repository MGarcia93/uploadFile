<?php

namespace upload\Exceptions;



class NotIsZip extends ExceptionUpload
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("Selecciono el formato zip pero el archivo leido no es un zip, formato recibido: $type", $code);
    }
}
