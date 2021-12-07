<?php

namespace upload;

use upload\basefile;
use upload\Exceptions\NotFile;
use upload\Exceptions\TypeInvalid;
use upload\pdf;

final class upload
{
    private  basefile $uploaded;
    protected array $validType = ['pdf', 'image', 'zip'];


    function __construct(string $type, array $files, string $product, string $date, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = $this->factory(strtolower($type));
        $this->loadFiles($files);
        $this->uploaded->setResolution($width, $height);
        $this->uploaded->setProduct($product);
        $this->uploaded->setDate($date);
    }
    private function loadFiles(array $files)
    {
        if (empty($files)) {
            throw new NotFile();
        }
        $this->uploaded->loadFiles(array_map(function ($file) {
            if (empty($file)) {
                throw new NotFile();
            }
            return $file;
        }, $files['tmp_name']));
    }
    public function __invoke(): void
    {
        $this->uploaded->__invoke();
        unset($this->uploaded);
    }
    private function  isValidType(string $type): bool
    {
        return in_array($type, $this->validType);
    }
    private function factory(string $type): basefile
    {
        if (!$this->isValidType($type))
            throw new TypeInvalid("$type", implode(",", $this->validType));

        switch ($type) {
            case 'pdf':
                $uploaded = new pdf();
                break;
            case 'image':
                $uploaded = new image();
                break;
            case 'zip':
                $uploaded = new zip();
                break;
        }
        return $uploaded;
    }
}
