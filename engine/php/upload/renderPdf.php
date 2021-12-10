<?php

namespace upload;

use Spatie\PdfToImage\Pdf;

class renderPdf extends Pdf
{

    private int  $numberOfPage;
    protected $validOutputFormats = ['jpg', 'jpeg', 'png', 'webp'];
    public function getNumberOfPages()
    {
        if (empty($this->numberOfPage)) {
            $this->numberOfPage = parent::getNumberOfPages();
        }
        return $this->numberOfPage;
    }

    public function getImageData($pathToImage)
    {
        $imagick = new \Imagick();
        $imagick->setColorspace(\Imagick::COLORSPACE_SRGB);
        $imagick->setResolution($this->resolution, $this->resolution);
        $imagick->readImage(sprintf('%s[%s]', $this->pdfFile, $this->page - 1));
        $imagick->mergeImageLayers(\Imagick::LAYERMETHOD_FLATTEN);
        $imagick->setFormat($this->determineOutputFormat($pathToImage));

        return $imagick;
    }
}
