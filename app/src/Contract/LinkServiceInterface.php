<?php

namespace App\Contract;

interface LinkServiceInterface
{
    public function create(string $url): ?string;
    public function getOriginalUrl(string $code): ?string;
}