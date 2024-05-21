<?php

namespace App\Web;

class Status
{
    private const array STATUSES = [
        200 => 'OK',
        400 => 'Bad Request',
    ];

    public function getName(int $code)
    {
        return self::STATUSES[$code];
    }
}
