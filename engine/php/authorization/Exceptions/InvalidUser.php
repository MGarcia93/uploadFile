<?php

namespace authorization\Exceptions;

use Exceptions\Handle;

class InvalidUser extends Handle
{
    public function __construct()
    {
        parent::__construct("AUTHENTICATION_FAILURE", "Usuario invalido", 401);
    }
}
