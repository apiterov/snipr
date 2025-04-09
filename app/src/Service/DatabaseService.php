<?php

namespace App\Service;

use App\Contract\DatabaseServiceInterface;
use PDO;
use PDOStatement;

readonly class DatabaseService implements DatabaseServiceInterface
{
    private PDO $conn;

    private function __construct() {
        $data = sprintf('mysql:host=%s;dbname=%s', $_ENV['MYSQL_HOST'], $_ENV['MYSQL_DATABASE']);
        $this->conn = new PDO($data, $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query(string $query, array $params = []): PDOStatement
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}