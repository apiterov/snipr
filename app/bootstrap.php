<?php

use App\Contract\DatabaseServiceInterface;
use App\Contract\LinkServiceInterface;
use App\Contract\RouterServiceInterface;
use App\Contract\TwigServiceInterface;
use App\Service\DatabaseService;
use App\Service\EnvironmentService;
use App\Service\LinkService;
use App\Service\RouterService;
use App\Service\TwigService;
use DI\ContainerBuilder;
use function DI\create;
use function DI\get;

$containerBuilder = new ContainerBuilder();
$containerBuilder->addDefinitions([
    LinkServiceInterface::class => create(LinkService::class)
        ->constructor(get(DatabaseServiceInterface::class)),
    RouterServiceInterface::class => create(RouterService::class),
    DatabaseServiceInterface::class => create(DatabaseService::class),
    TwigServiceInterface::class => create(TwigService::class),
    EnvironmentService::class => create(EnvironmentService::class)
]);

return $containerBuilder->build();