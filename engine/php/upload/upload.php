<?php

namespace upload;

use ExceptionUpload;
use upload\basicFile;
use uploar\Exceptions\TypeInvalid;
use upload\pdf;

class upload
{
    private  basicFile $uploaded;
    protected array $validType = ['pdf', 'image', 'zip'];


    function __construct(string $type, iterable $files, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = $this->factory(strtolower($type));
        $this->loadFiles($files);
        $this->uploaded->setResolution($width, $height);
    }
    private function loadFiles(iterable $files){
        $file=[];
        foreach($files as $f){
            
        }
        $this->uploaded->loadFiles($files);
    }
    public function __invoke(): void
    {
        $this->uploaded->__invoke();
    }
    private function  isValidType(string $type): bool
    {
        return in_array($type, $this->validType);
    }
    private function factory(string $type): basicFile
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
