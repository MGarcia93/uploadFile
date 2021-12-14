<?php

namespace authorization\Exceptions;

use Exceptions\Handle;

class NotToken extends Handle
{
    public function __construct()
    {
        parent::__construct("AUTHENTICATION_FAILURE", "no se recibio token", 401);
    }
}
