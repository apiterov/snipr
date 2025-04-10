<?php

namespace App\Contract;

use PDOStatement;

interface DatabaseServiceInterface
{
    public function query(string $query, array $params = []): PDOStatement;
}