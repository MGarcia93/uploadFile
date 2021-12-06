<?php

namespace upload;

require_once "vendor/autoload.php";

use Spatie\PdfToImage\Pdf;


class pdf implements basicFile
{
    private iterable $files;

    function loadFiles(iterable $files): void
    {
        $this->files = $files;
    }
    function setResolution(?int $width = null, ?int $height = null): void
    {
    }
    public function __invoke(): void
    {


        foreach (glob(__DIR__ . "\\*.pdf") as $file) {

            $filename = explode(".", basename($file))[0];
            echo "file:$filename, path:$file</br>";
            $pdf = new Spatie\PdfToImage\Pdf($file);
            $p = $pdf->getNumberOfPages();

            $pdf->setOutputFormat('png')
                ->saveImage(__DIR__ . "\\$filename.png");
        }
        echo "fin";
    }
}
