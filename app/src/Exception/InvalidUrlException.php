<?php

namespace App\Exception;

use Exception;

class InvalidUrlException extends Exception
{
    public function __construct($message, $code = 0, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}