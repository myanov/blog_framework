<?php


class Router
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($pattern, $route = [])
    {
        self::$routes[$pattern] = $route;
    }

    public static function getRoutes()
    {
        return self::$routes;
    }

    public static function getRoute()
    {
        return self::$route;
    }

    public static function matchRoutes($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if($pattern == $url) {
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
}