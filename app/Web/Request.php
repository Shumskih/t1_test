<?php

namespace App\Web;

class Request
{
    private array $json = [];

    public function __construct()
    {
        $json = json_decode(file_get_contents("php://input"), true);

        if (!empty($json)) {
            $this->json = $json;
        }
    }

    public function getJson()
    {
        return $this->json;
    }
}