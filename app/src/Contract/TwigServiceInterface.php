<?php

namespace App\Contract;

interface TwigServiceInterface
{
    public function render(string $page, array $params = []): void;
}