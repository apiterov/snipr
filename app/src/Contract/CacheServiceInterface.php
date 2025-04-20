<?php

namespace App\Contract;

interface CacheServiceInterface
{
    public function get(string $key): mixed;

    public function set(string $key, mixed $value, int $expiration): bool;

    public function delete(string $key): bool;
}