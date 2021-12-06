<?php

namespace upload;

class pdf implements basicFile
{
    private array $files;
    private ?int $width;
    private ?int $height;
    private string $product;
    private int $countImage = 0;
    const TEMP = __DIR__ . "\\img\\temp.png";

    function loadFiles(array $files): void
    {
        $this->files = $files;
    }
    function setResolution(?int $width = null, ?int $height = null): void
    {
        $this->width = $width;
        $this->height = $height;
    }
    function setProduct(string $product): void
    {
        $this->product = $product;
    }
    public function __invoke(): void
    {
        foreach ($this->files as $file) {
            $filename = explode(".", basename($file))[0];
            $pdf = new \Spatie\PdfToImage\Pdf($file);
            $quantityPage = $pdf->getNumberOfPages();
            for ($i = 0; $i < $quantityPage; $i++) {
                $pdf->setPage($i + 1);
                $pdf->getPag->setOutputFormat('png')
                    ->saveImage(self::TEMP);
                $this->createImage();
            }
        }
    }
    private function incrementCount()
    {
        $this->countImage++;
    }
    private function getNameImage()
    {
        return __DIR__ . "/img/pages/{$this->product}" . date('dmY') . "-" . str_pad($this->countImage, 3, "0", STR_PAD_RIGHT) . "P.png";
    }
    private function createImage()
    {
        global $_CONFIG;
        list($widthImg, $heightImg) = getimagesize(self::TEMP);
        if ($this->width == null) {
            $this->width = $widthImg;
            $this->height = $heightImg;
        }

        if ($this->width > $widthImg * 1.15) {
            //is doble image 
            $this->divideImage();
        } else {
            $this->incrementCount();
            rename(self::TEMP, $this->getNameImage());
        }
    }

    private function divideImage()
    {
        $image = imagecreatefrompng(self::TEMP);
        list($width, $height) = getimagesize(self::TEMP);
        $newWidth = round($width / 2);
        for ($i = 0; $i < 2; $i++) {
            $this->incrementCount();
            $newImage = imagecreatetruecolor($newWidth, $height);
            imagecopyresampled($newImage, $image, 0, 0, $width * $i, 0, $width, $height, $width, $height);
            imagepng($newImage, $this->getNameImage, 7);
        }
    }
}
