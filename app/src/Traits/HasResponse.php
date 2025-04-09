<?php

namespace App\Traits;

use JetBrains\PhpStorm\NoReturn;

trait HasResponse
{
    #[NoReturn] private function response($data, $status): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}