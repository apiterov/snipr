<?php

namespace App\Service;

use App\Contract\CacheServiceInterface;
use Memcached;

class CacheService implements CacheServiceInterface
{
    private Memcached $memcached;

    public function __construct()
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer($_ENV['CACHE_HOST'], $_ENV['CACHE_PORT']);
    }

    public function get(string $key): mixed
    {
        return $this->memcached->get($key);
    }

    public function set(string $key, $value, int $expiration = 3600): bool
    {
        return $this->memcached->set($key, $value, $expiration);
    }

    public function delete(string $key): bool
    {
        return $this->memcached->delete($key);
    }
}