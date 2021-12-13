<?php

namespace upload\Exceptions;

use Exceptions\Handle;


class TypeInvalid extends Handle
{
    function __construct(string $messange = "", $typeValid = "")
    {
        parent::__construct("TYPE_INVALID ", "tipo de archivo invalido:$messange - tipos de archivos validos $typeValid");
    }
}
