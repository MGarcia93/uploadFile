<?php

namespace upload;

use upload\Exceptions\NotIsZip;
use upload\Exceptions\TypeInvalid;
use upload\Type\Image as TypeImage;
use upload\Type\Pdf as TypePdf;
use upload\Type\Zip as TypeZip;

use function PHPUnit\Framework\fileExists;

final class zip extends baseFile
{
    private string $folder;

    function __construct()
    {
        $this->mymetype = TypeZip::getTypes();
        $this->folder = dirbase . "\\" . (string) uniqid("extract");
    }
    private function extract($file)
    {
        $zip = new \ZipArchive;
        if (!fileExists($this->folder)) {
            mkdir($this->folder, "777");
        }
        $zip->open($file);
        $zip->extractTo('./');
        $zip->close();
    }
    private function readFolder()
    {
        $files = [];
        foreach (glob($this->folder . "\\*.*") as $file) {
            if (is_file($file))
                $files[] = $file;
        }
        return $files;
    }
    function __invoke()
    {
        foreach ($this->files as $file) {
            if (!$this->isValidFormat($file)) {
                throw new NotIsZip($this->getMymeTypeFile($file));
            }
            $this->extract($file);
            $newFiles = $this->readFolder();
            $UploadedForType = $this->getUploadedForType($newFiles[0]);
            $UploadedForType->loadFiles($newFiles);
            $UploadedForType->setResolution($this->width, $this->height);
            $UploadedForType->setProduct($this->product);
            $UploadedForType->setDate($this->date);
            $UploadedForType();
        }
    }
    private function getUploadedForType(string $file): baseFile
    {
        $mymetype = $this->getMymeTypeFile($file);
        if (in_array($mymetype, TypeImage::getTypes())) {
            $uploaded = new image();
        } else if (in_array($mymetype, TypePdf::getTypes())) {
            $uploaded = new image();
        } else {
            throw new TypeInvalid();
        }
        return $uploaded;
    }
    private function deleteFolder()
    {
        rmdir($this->folder);
    }
    function __destruct()
    {
        $this->deleteFolder();
    }
}
