<?php

namespace authorization\Exceptions;

use Exceptions\Handle;

class UserIncorrect extends Handle
{
    public function __construct()
    {
        parent::__construct("AUTHENTICATION_FAILURE", "Usuario o password incorrecto", 403);
    }
}
