<?php

namespace App\Web;

class Response
{
    public function setStatus(int $code): void
    {
        header("HTTP/1.1 " . $code . " " . (new Status())->getName($code));
    }

    public function json(array $data): string|false
    {
        header('Content-Type: application/json');

        return json_encode($data);
    }
}