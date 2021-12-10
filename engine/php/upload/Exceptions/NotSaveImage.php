<?php

namespace upload\Exceptions;



class NotSaveImage extends ExceptionUpload
{
    function __construct($img = "", $code = 400)
    {
        parent::__construct("No se pudo grabar la imagen:$img", $code);
    }
}
