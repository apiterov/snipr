<?php

namespace App\Service;

use App\Traits\HasResponse;

final class RouterService
{
    use HasResponse;
    private array $routes;

    private static ?self $instance = null;

    private function __construct()
    {
        $this->routes = require __DIR__ . '/../../routes/api.php';
    }

    public static function init(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
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

        $this->response(['message' => 'Not found'], 404);
    }
}