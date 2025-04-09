<?php

use App\Service\RouterService;

require_once __DIR__ . '/vendor/autoload.php';

RouterService::init()
    ->route($_SERVER['REQUEST_URI']);