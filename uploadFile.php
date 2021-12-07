<?php
require_once "initiliaze.php";

use upload\upload;

define("dirbase", __dir__);
require_once "Engine/php/vendor/autoload.php";

header('Content-Type: application/json; charset=utf-8');
if (empty($_POST)) {
    $_POST = file_get_contents('php://input');
}
class UploadFile
{
    private $uploaded;
    function __construct(string $type, array $files, string $product, string $date, ?int $width = null, ?int $height = null)
    {
        $this->uploaded = new upload($type, $files, $product, $date, $width, $height);
    }
    function __invoke()
    {
        $this->uploaded->__invoke();
        http_response_code(204);
    }
}
try {

    $uploaded = new UploadFile($_POST['type'] ?? "void", $_FILES['file'], $_POST['product'], $_POST['date']);
    $uploaded();
} catch (\Exception $ex) {
    die();
}
