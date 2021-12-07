<?php

namespace upload\Type;

final class Zip
{
    static function getTypes()
    {
        return [
            "application/zip",
            //No implementados todavia estos tipos
            /* "application/x-7z", 
            "application/x-7z-compressed",
            "application/x-rar-compressed",
            "application/x-rar"*/
        ];
    }
}
