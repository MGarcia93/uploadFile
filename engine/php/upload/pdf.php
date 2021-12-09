<?php

namespace upload;

use upload\Exceptions\NotIsPdf;
use upload\Type\Pdf as TypePdf;

final class pdf extends baseFile
{

    function __construct()
    {
        parent::__construct();
        $this->mymetype = TypePdf::getTypes();
    }
    public function __invoke(): void
    {

        foreach ($this->files as $file) {

            if (!$this->isValidFormat($file)) {
                throw new NotIsPdf($this->getMymeTypeFile($file));
            }
            $pdf = new renderPdf($file);
            $quantityPage = $pdf->getNumberOfPages();
            for ($i = 0; $i < $quantityPage; $i++) {
                $pdf->setPage($i + 1);
                $pdf->setOutputFormat('jpg')
                    ->saveImage($this->pathFileTemp());
                $this->createImage();
            }
        }
    }

    protected function createImage()
    {
        list($widthImg, $heightImg) = getimagesize($this->pathFileTemp());
        if ($this->width == null) {
            $this->width = $widthImg;
            $this->height = $heightImg;
        }

        if ($widthImg > ($this->width * 1.15)) {
            //is doble image 
            $this->divideImage();
        } else {
            parent::createImage();
        }
    }

    private function divideImage()
    {
        $image = imagecreatefromjpeg($this->pathFileTemp());
        list($width, $height) = getimagesize($this->pathFileTemp());
        $newWidth = round($width / 2);
        for ($i = 0; $i < 2; $i++) {
            $this->incrementCount();
            $newImage = imagecreatetruecolor($newWidth, $height);
            imagecopyresampled($newImage, $image, 0, 0, $newWidth * $i, 0, $newWidth, $height, $newWidth, $height);
            imagewebp($newImage, $this->getNameImage());
            imagedestroy($newImage);
        }
        imagedestroy($image);
    }
}
