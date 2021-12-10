<?php

namespace upload;

class baseFile
{
    protected array $files;
    protected ?int $width;
    protected ?int $height;
    protected string $date;
    protected string $product;
    protected array $mymetype;
    protected int $countImage = 0;
    protected string $fileTemp;

    function __construct()
    {
        $this->fileTemp = dirbase . "\\Temp\\" . (string) uniqid("temp");
    }
    public function __invoke()
    {
    }
    protected function getMymeTypeFile($file)
    {
        return \mime_content_type($file);
    }
    protected function isValidFormat($file): bool
    {
        return in_array($this->getMymeTypeFile($file), $this->mymetype);
    }
    public function loadFiles(array $files): void
    {
        $this->files = $files;
    }
    public function setResolution(?int $width = null, ?int $height = null): void
    {
        $this->width = $width;
        $this->height = $height;
    }
    public function setProduct(string $product): void
    {
        $this->product = strtoupper($product);
    }

    public  function setDate(?string $date): void
    {
        $this->date = !empty($date) ? date("dmy",  strtotime($date)) : date("dmy");
    }
    protected function incrementCount()
    {
        $this->countImage++;
    }

    protected function pathFileTemp($ext = "jpg")
    {
        return "{$this->fileTemp}.{$ext}";
    }

    protected function createImage()
    {

        $this->incrementCount();
        switch ($this->getMymeTypeFile($this->pathFileTemp())) {
            case "image/jpeg":
                $image = imagecreatefromjpeg($this->pathFileTemp());
                break;
            case "image/webp":
                rename($this->pathFileTemp(), $this->getNameImage());
                return;
                break;
            case "image/png":
                $image = imagecreatefrompng($this->pathFileTemp());
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
        }
        imagewebp($image, $this->getNameImage());
        imagedestroy($image);
    }
    protected function getNameImage()
    {
        return dirbase . "/img/pages/{$this->product}{$this->date}-" . str_pad($this->countImage, 3, "0", STR_PAD_LEFT) . "P.webp";
    }
}
