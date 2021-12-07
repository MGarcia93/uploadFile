<?php

namespace upload;

use upload\Exceptions\NotIsPdf;
use upload\Type\Pdf as TypePdf;

final class pdf extends baseFile
{
    const TEMP = dirbase . "\\img\\temp.jpg";
    function __construct()
    {
        $this->mymetype = TypePdf::getTypes();
    }
    public function __invoke(): void
    {
        foreach ($this->files as $file) {
            if (!$this->isValidFormat($file)) {
                throw new NotIsPdf($this->getMymeTypeFile($file));
            }
            $pdf = new \Spatie\PdfToImage\Pdf($file);
            $quantityPage = $pdf->getNumberOfPages();
            for ($i = 0; $i < $quantityPage; $i++) {
                $pdf->setPage($i + 1);
                $pdf->setOutputFormat('jpg')
                    ->saveImage(self::TEMP);
                $this->createImage();
            }
        }
    }

    private function createImage()
    {

        list($widthImg, $heightImg) = getimagesize(self::TEMP);
        if ($this->width == null) {
            $this->width = $widthImg;
            $this->height = $heightImg;
        }

        if ($widthImg > ($this->width * 1.15)) {
            //is doble image 
            $this->divideImage();
        } else {
            $this->incrementCount();
            rename(self::TEMP, $this->getNameImage());
        }
    }

    private function divideImage()
    {
        $image = imagecreatefromjpeg(self::TEMP);
        list($width, $height) = getimagesize(self::TEMP);
        $newWidth = round($width / 2);
        for ($i = 0; $i < 2; $i++) {
            $this->incrementCount();
            $newImage = imagecreatetruecolor($newWidth, $height);
            imagecopyresampled($newImage, $image, 0, 0, $newWidth * $i, 0, $newWidth, $height, $newWidth, $height);
            imagejpeg($newImage, $this->getNameImage(), 7);
        }
    }
}
