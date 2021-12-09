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
        file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "inicio de Upload pdf:{$this->pathFileTemp()}" . PHP_EOL, FILE_APPEND);
        foreach ($this->files as $file) {
            file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "inicio de manejo de file:{$file}" . PHP_EOL, FILE_APPEND);
            if (!$this->isValidFormat($file)) {
                throw new NotIsPdf($this->getMymeTypeFile($file));
            }
            file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "creo pdftoimage class" . PHP_EOL, FILE_APPEND);
            $pdf = new renderPdf($file);
            file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "busco cantidad de paginas en el pdf:{$file}" . PHP_EOL, FILE_APPEND);
            $quantityPage = $pdf->getNumberOfPages();
            for ($i = 0; $i < $quantityPage; $i++) {
                file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "seteo pagina:{$i}" . PHP_EOL, FILE_APPEND);
                $pdf->setPage($i + 1);
                file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "grabo imagen temporal" . PHP_EOL, FILE_APPEND);
                $pdf->setOutputFormat('jpg')
                    ->saveImage($this->pathFileTemp());
                $this->createImage();
            }
            file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "fin de manejo de file:{$file}" . PHP_EOL, FILE_APPEND);
        }
        file_put_contents("temp/execution.t",  date("Ymd h:i:s:v") . "-" . "fin de Upload pdf:{$this->pathFileTemp()}" . PHP_EOL, FILE_APPEND);
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
