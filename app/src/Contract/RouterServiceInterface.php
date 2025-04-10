<?php

namespace App\Contract;

interface RouterServiceInterface
{
    public function route(string $uri): void;
}