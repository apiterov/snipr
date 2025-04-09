<?php

namespace App\Service;

use Dotenv\Dotenv;

final class EnvironmentService
{
    private static EnvironmentService $instance;

    public static function init(): EnvironmentService
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }
}