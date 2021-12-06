<?php
require_once "initiliaze.php";

use upload\upload;
use Upload\Exceptios\ExceptionUpload;

header('Content-Type: application/json; charset=utf-8');
class UploadFile
{
    private $uploaded;
    function __construct(string $type, iterable $files, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = new upload($type, $files, $width, $height);
    }
    function __invoke()
    {
        $this->uploaded();
    }
}
try {
} catch (ExceptionUpload $ex) {
    die();
}
