<?php namespace Core;

use Closure;

class Application {

    private array $routes = [];

    public function run(string $basePath = '/') {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = $_SERVER['PATH_INFO'] ?? $basePath;

        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        $callback = $this->routes[$method][$path];

        if (is_array($callback)) {
            [$controller, $action] = $callback;
            $controllerInstance = new $controller();
            $callback = [$controllerInstance, $action];
        }

        call_user_func($callback);
    }

    public function get(string $path, array | Closure $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, array | Closure $callback) {
        $this->routes['POST'][$path] = $callback;
    }
}