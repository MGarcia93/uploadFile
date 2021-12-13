<?php

namespace upload\Exceptions;

use Exceptions\Handle;



class NotSaveImage extends Handle
{
    function __construct($img = "", $code = 400)
    {
        parent::__construct("SAVE_ERROR", "No se pudo grabar la imagen:$img", $code);
    }
}
