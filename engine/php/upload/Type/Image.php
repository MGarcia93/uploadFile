<?php

namespace upload\Type;

final class Image
{
    static function getTypes()
    {
        return [
            "image/jpeg",
            "image/webp",
            "image/png",
        ];
    }
}
