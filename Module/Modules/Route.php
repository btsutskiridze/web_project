<?php

class Route
{
    public static array $validRoutes = [];
    public static array $middlewares = [];


    public static function get(string $route, $handler, $middlewares = []): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::set($route, $handler, $middlewares);
    }

    public static function post(string $route, $handler, $middlewares = []): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::set($route, $handler, $middlewares);
    }

    public static function notFound($handler): void
    {
        if (!in_array($_SERVER['REQUEST_URI'], self::$validRoutes))
            $handler->__invoke();

    }

    private static function set(string $route, $handler, $middlewares = []): void
    {
        self::$validRoutes[] = $route;
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($uri !== $route) {
            return;
        }

        self::handleMiddlewares($middlewares);

        if (!is_callable($handler)) {
            self::handleControllerMethod($handler);
            return;
        }

        $handler->__invoke();
    }


    private static function handleControllerMethod(string $handler): void
    {
        $handlerParts = explode('@', $handler);
        $controllerName = $handlerParts[0];
        $methodName = $handlerParts[1];

        if (!class_exists($controllerName)) {
            die('Controller class does not exist');
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $methodName)) {
            die('Controller method does not exist');
        }

        $controller->$methodName();

    }

    public static function setMiddlewares($middleware): void
    {
        self::$middlewares[] = array_merge(self::$middlewares, $middleware);
    }

    public static function handleMiddlewares(array $middlewares): void
    {
        $middlewares = array_merge(self::$middlewares, $middlewares);

        foreach ($middlewares as $middleware) {
            if (is_callable($middleware)) {
                $middleware();
            }
        }
    }
}