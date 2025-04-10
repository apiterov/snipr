<?php

namespace App\Service;

use App\Contract\DatabaseServiceInterface;
use App\Contract\LinkServiceInterface;
use App\Util\UriGenerator;
use PDO;

class LinkService implements LinkServiceInterface
{
    public function __construct(
        private readonly DatabaseServiceInterface $db
    ) {}

    public function create(string $url): ?string
    {
        $code = UriGenerator::generate($url);
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
        $query = 'SELECT original_url FROM links WHERE short_code = :code';
        $stmt = $this->db->query($query, [
            'code' => $code,
        ]);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $row = $stmt->fetch();
        return $row->original_url;
    }
}