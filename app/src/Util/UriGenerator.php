<?php

namespace App\Util;

class UriGenerator
{
    public static function generate($originalUrl): string
    {
        return substr(md5($originalUrl), 0, 6);
    }
}