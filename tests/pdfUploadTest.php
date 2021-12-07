<?php
require_once "initiliaze.php";
require_once "Engine/php/vendor/autoload.php";

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

final class pdfUploadTest extends TestCase
{
    public function testCanBeUploadSuccesFull()
    {
        $client = new Client();

        $option = [
            'multipart' => [
                [
                    'name' => "type",
                    'contents' => "pdf"
                ],
                [

                    'Content-type' => 'multipart/form-data',
                    'name' => 'file[]',
                    'contents' => fopen('page/1202seg001.pdf', 'r'),



                ],
                [

                    'Content-type' => 'multipart/form-data',
                    'name' => 'file[]',
                    'contents' => fopen('page/1202seg002.pdf', 'r'),
                    'filename' => '1202seg002.pdf',



                ]
            ],
        ];
        $response = $client->post("http://localhost/pdf-to-image/file.php", $option);
        var_dump($response->getBody()->getContent());
        $this->assertEsquals($response->getStatusCode(), 200);
    }
}
