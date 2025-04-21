<?php

namespace App\Contract;

use App\Exception\InvalidUrlException;

interface LinkServiceInterface
{
    /**
     * @param string $url
     * @return string|null
     * @throws InvalidUrlException
     */
    public function create(string $url): ?string;

    /**
     * @param string $code
     * @return string|null
     */
    public function getOriginalUrl(string $code): ?string;
}