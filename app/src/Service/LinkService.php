<?php

namespace App\Service;

use App\Contract\CacheServiceInterface;
use App\Contract\DatabaseServiceInterface;
use App\Contract\LinkServiceInterface;
use App\Exception\InvalidUrlException;
use App\Util\UriGenerator;
use PDO;

class LinkService implements LinkServiceInterface
{
    public function __construct(
        private readonly DatabaseServiceInterface $db,
        private readonly CacheServiceInterface    $cache
    )
    {
    }

    /**
     * @throws InvalidUrlException
     */
    public function create(string $url): ?string
    {
        $code = UriGenerator::generate($url);
        $this->cache->set($code, $url);
        $query = 'INSERT IGNORE INTO links (original_url, short_code, expires_at) VALUES (:url, :code, :exp)';
        $this->db->query($query, [
            'url' => $url,
            'code' => $code,
            'exp' => date('Y-m-d H:i:s', time() + 86400),
        ]);
        return rtrim($_ENV['BASE_URL'], '/') . '/' . $code;
    }

    public function getOriginalUrl(string $code): ?string
    {
        $cacheUrl = $this->cache->get($code);
        if ($cacheUrl) {
            return $cacheUrl;
        }

        $query = 'SELECT original_url FROM links WHERE short_code = :code';
        $stmt = $this->db->query($query, [
            'code' => $code,
        ]);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $row = $stmt->fetch();

        if ($row) {
            $this->cache->set($code, $row->original_url);
            return $row->original_url;
        }

        return null;
    }
}