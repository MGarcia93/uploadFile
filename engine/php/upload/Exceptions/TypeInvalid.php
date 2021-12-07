<?php

namespace upload\Exceptions;


class TypeInvalid extends ExceptionUpload
{
    function __construct(string $messange = "", $typeValid = "")
    {
        parent::__construct("tipo de archivo invalido:$messange - tipos de archivos validos $typeValid");
    }
}
