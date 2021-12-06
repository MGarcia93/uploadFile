<?php
require_once "initiliaze.php";

use upload\upload;

require_once "Engine/vendor/autoload.php";

header('Content-Type: application/json; charset=utf-8');
if (empty($_POST)) {
    $_POST = file_get_contents('php://input');
}
class UploadFile
{
    private $uploaded;
    function __construct(string $type, array $files, string $product, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = new upload($type, $files, $product, $width, $height);
    }
    function __invoke()
    {
        $this->uploaded->__invoke();
    }
}
try {
    $uploaded = new upload($_POST['type'] ?? "void", $_FILES['file'], $_POST['product']);
    $uploaded();
} catch (Exception $ex) {
    die();
}
