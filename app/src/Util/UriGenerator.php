<?php

namespace App\Util;

use App\Exception\InvalidUrlException;

class UriGenerator
{
    /**
     * @throws InvalidUrlException
     */
    public static function generate($originalUrl): string
    {
        $pattern = '/^https?:\/\/(?:www\.)?[a-zA-Z0-9-]+\.[a-zA-Z]{2,}(?:\/[^\s]*)?$/';
        if (!preg_match($pattern, $originalUrl)) {
            throw new InvalidUrlException('Invalid URL');
        }
        return substr(md5($originalUrl), 0, 9);
    }
}