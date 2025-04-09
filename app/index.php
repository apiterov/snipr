<?php

use App\Service\EnvironmentService;
use App\Service\RouterService;

require_once __DIR__ . '/vendor/autoload.php';

EnvironmentService::init();

RouterService::init()
    ->route($_SERVER['REQUEST_URI']);