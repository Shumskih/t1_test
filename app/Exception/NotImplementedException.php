<?php

namespace App\Exception;

use Exception;

class NotImplementedException extends Exception
{
    public function __construct($message = 'Не реализовано!', $code = 400, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}