<?php

namespace AlgoliaTest\Lib;

class Router
{
    protected $routes = [];

    public function add($pattern, $controller, $methods = ['GET'])
    {
        $this->routes[] = ['#^' . $pattern . "/?$#", $methods, $controller];
    }

    public function match($uri, $method = 'GET')
    {
        $path = parse_url($uri, PHP_URL_PATH);
        foreach ($this->routes as $route) {
            if (in_array($method, $route[1]) && preg_match($route[0], $path, $parameters)) {
                return function () use ($route, $parameters) {
                    return call_user_func_array($route[2], array_slice($parameters, 1));
                };
            }
        }

        return false;
    }
}
