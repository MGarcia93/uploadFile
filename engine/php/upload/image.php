<?php

namespace upload;

use upload\Exceptions\NotIsImage;
use upload\Type\Image as TypeImage;

final class image extends baseFile
{
    function __construct()
    {
        $this->mymetype = TypeImage::getTypes();
    }
    function __invoke()
    {
        foreach ($this->files as $file) {
            if (!$this->isValidFormat($file)) {
                throw new NotIsImage($this->getMymeTypeFile($file));
            }
            $this->incrementCount();
            $ext = image_type_to_extension(getimagesize($file)[2]);
            rename($file, $this->getNameImage($ext));
        }
    }
}
