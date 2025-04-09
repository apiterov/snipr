<?php

use App\Service\EnvironmentService;
use App\Service\RouterService;

require_once __DIR__ . '/vendor/autoload.php';

new EnvironmentService()
    ->init();

new RouterService()
    ->route($_SERVER['REQUEST_URI']);