<?php

namespace App\Service;

use App\Contract\RouterServiceInterface;
use App\Traits\HasResponse;

readonly class RouterService implements RouterServiceInterface
{
    use HasResponse;

    private array $routes;

    public function __construct() {
        $this->routes = require __DIR__ . '/../../routes/api.php';
    }

    public function route(string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes as $route => $action) {
            $routePattern = "~^" . $route . "$~";
            if (preg_match($routePattern, $uri, $matches)) {
                $controller = $action['controller'];
                $method = $action['method'];
                array_shift($matches);

                $controllerInstance = new $controller();
                call_user_func_array([$controllerInstance, $method], $matches);
                return;
            }
        }

        $this->responseJson(['message' => 'Not found'], 404);
    }
}