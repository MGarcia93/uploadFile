<?php

namespace upload;

use Spatie\PdfToImage\Pdf;

class renderPdf extends Pdf
{

    private int  $numberOfPage;

    public function getNumberOfPages()
    {
        if (empty($this->numberOfPage)) {
            $this->numberOfPage = parent::getNumberOfPages();
        }
        return $this->numberOfPage;
    }
}
