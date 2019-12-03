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
            if(preg_match("#$pattern#i", $url, $matches)) {
                foreach($matches as $k => $v) {
                    if(is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        if(self::matchRoutes($url)) {
            $controller = self::upperToStr(self::$route['controller']);
            if(!isset(self::$route['action'])) {
                self::$route['action'] = 'index';
            }
            if(class_exists($controller)) {
                $cObj = new $controller;
                $action = self::lowerToStr(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)) {
                    $cObj->$action();
                } else {
                    echo "Метода <b>$action</b> не существует";
                }
            } else {
                echo "Контроллера <b>$controller</b> не существует";
            }
        } else {
            http_response_code(404);
            echo "Такой страницы не найдено";
        }
    }

    protected static function upperToStr($str)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
    }

    protected static function lowerToStr($str)
    {
        return lcfirst(self::upperToStr($str));
    }
}