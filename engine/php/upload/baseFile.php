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
        $this->product = $product;
    }

    public  function setDate(?string $date): void
    {
        $this->date = date("dmy", !empty($date) ? strtotime($date) : "now");
    }
    protected function incrementCount()
    {
        $this->countImage++;
    }
    protected function getNameImage($ext = "jpg")
    {
        return dirbase . "/img/pages/{$this->product}{$this->date}-" . str_pad($this->countImage, 3, "0", STR_PAD_LEFT) . "P.{$ext}";
    }
}
