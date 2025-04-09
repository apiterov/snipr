<?php

namespace App\Service;

use App\Contract\EnvironmentServiceInterface;
use Dotenv\Dotenv;

readonly class EnvironmentService implements EnvironmentServiceInterface
{
    public function init(): void
    {
        Dotenv::createImmutable(dirname(__DIR__, 2))->load();
    }
}