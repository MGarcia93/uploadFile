<?php

namespace api;

class Api
{

    protected function  response($data = "", $code): void
    {
        header_remove();
        header('Content-Type: application/json; charset=utf-8');

        http_response_code($code);
        if (!empty($data)) {
            echo json_encode(["data" => $data]);
        }
        exit();
    }
}
