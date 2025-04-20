<?php

namespace App\Contract;

interface CacheServiceInterface
{
    public function get(string $key): mixed;

    public function set(string $key, mixed $value, int $expiration = 0): bool;

    public function delete(string $key): bool;
}