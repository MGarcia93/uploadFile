<?php

namespace upload\Exceptions;



class NotIsImage extends ExceptionUpload
{
    function __construct($type = "", $code = 400)
    {
        parent::__construct("Selecciono el typo imagen pero el archivo leido no es una imagen, formato recibido: $type", $code);
    }
}
