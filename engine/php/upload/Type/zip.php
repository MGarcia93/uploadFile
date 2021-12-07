<?php

namespace upload\Type;

final class Zip
{
    static function getTypes()
    {
        return [
            "application/zip",
            "application/x-7z-compressed",
            "application/x-rar-compressed"
        ];
    }
}
