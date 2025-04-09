<?php

namespace App\Service;

use App\Util\UriGenerator;

final class LinkService
{
    private DatabaseService $db;

    private static ?self $instance = null;

    private function __construct(DatabaseService $db)
    {
        $this->db = $db;
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self(
                DatabaseService::init()
            );
        }
        return self::$instance;
    }

    public function create(string $url): ?string
    {
        $code = UriGenerator::generate($url);
        $query = 'INSERT INTO links (original_url, short_code, created_at, expires_at) VALUES (:url, :code, :cre, :exp)';
        $this->db->query($query, [
            'url' => $url,
            'code' => $code,
            'cre' => time(),
            'exp' => time() + 3600,
        ]);
        return $code;
    }
}