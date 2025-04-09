<?php

use App\Controller\HomeController;
use App\Controller\LinkController;

return [
    '/link' => [
        'controller' => LinkController::class,
        'method' => 'createLink'
    ],
    '/([a-zA-Z0-9]{9})' => [
        'controller' => LinkController::class,
        'method' => 'getLink'
    ],

    '/' => [
        'controller' => HomeController::class,
        'method' => 'index'
    ]
];