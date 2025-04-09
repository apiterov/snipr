<?php

namespace App\Service;

use PDO;
use PDOStatement;

final class DatabaseService
{
    private static ?self $instance = null;

    private PDO $conn;

    private function __construct()
    {
        $data = sprintf('mysql:host=%s;dbname=%s', $_ENV['MYSQL_HOST'], $_ENV['MYSQL_DATABASE']);
        $this->conn = new PDO($data, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}