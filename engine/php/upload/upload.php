<?php

namespace upload;

use ExceptionUpload;
use uploar\Exceptions\FormatInvalid;
use uploar\Exceptions\TypeInvalid;

class upload
{
    private  basicFile $uploaded;
    protected array $validType = ['pdf', 'image', 'zip'];


    function __construct(string $type, iterable $files, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = $this->factory(strtolower($type));
        $this->uploaded->loadFiles($files);
        $this->uploaded->setResolution($width, $height);
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
