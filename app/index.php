<?php

use App\Service\EnvironmentService;
use App\Service\RouterService;

require_once __DIR__ . '/vendor/autoload.php';

$container = require __DIR__ . '/bootstrap.php';

$container->get(EnvironmentService::class)
    ->init();

$container->get(RouterService::class)
    ->route($_SERVER['REQUEST_URI']);