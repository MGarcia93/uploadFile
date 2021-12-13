<?php

namespace Exceptions;

class NotParam extends Handle
{

    public function __construct($code = 400)
    {
        parent::__construct("WITHOUT_PARAMETERS", "no se recibieron parametros", $code);
    }
}
