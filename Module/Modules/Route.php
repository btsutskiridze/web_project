<?php

class Route
{
    public static array $validRoutes = [];


    public static function get(string $route, $handler): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }
        self::set($route, $handler);
    }

    public static function post(string $route, $handler): void
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::set($route, $handler);
    }


    private static function set(string $route, $handler): void
    {
        self::$validRoutes[] = $route;
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($uri !== $route) {
            return;
        }

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
}