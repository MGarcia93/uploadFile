<?php
require_once 'Initialize.php';
require_once "Engine/php/vendor/autoload.php";
error_reporting(E_ALL);


use authorization\Auth;

class Index
{

    private $Template;
    private $Log;
    private $product;


    function __construct()
    {

        $this->Template = new CTemplateManager('Template/upload/');
        $this->Template->LoadTpl("Layout");
        $this->Log = CLogManager::getObject();
        $this->Log->Init("Estado Edicion", "");
    }

    public function __invoke(): void
    {
        try {

            $this->Context();
            $this->ExitInstance();
        } catch (Exception $ex) {
            $this->Log->Log(1, "ERROR:" . $ex->getMessage());
            header("Location: Error.php?e=" . $ex->getMessage() . "&pr=" . $this->product);
            exit();
        }
    }


    function Context()
    {
        global $_CONFIG;

        $content = new CTemplateManager('Template/upload/');

        if (Auth::isLogin()) {

            $content->LoadTpl("uploadFile");
            $content->InsertTag("URL_UPLOAD", $_CONFIG['Url_upload']);
            $content->InsertTag('TOKEN', Auth::getToken());
        } else {
            $content->LoadTpl("Login");
        }

        $this->Template->InsertTag("CONTENT", $content->Render());
    }

    function ExitInstance()
    {

        echo $this->Template->Render();
    }
}

$page = new Index();
$page();
