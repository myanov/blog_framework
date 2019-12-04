<?php

namespace vendor\core;


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
                $route['controller'] = self::upperCamelStr($route['controller']);
                isset($route['action']) ? $route['action'] = self::lowerCamelStr($route['action']) : '';
                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    public static function dispatch($url)
    {
        $url = self::clearUrl($url);
        if(self::matchRoutes($url)) {
            $controller = 'app\controllers\\' . self::$route['controller'];
            if(!isset(self::$route['action'])) {
                self::$route['action'] = 'index';
            }
            if(class_exists($controller)) {
                $cObj = new $controller(self::$route);
                $action = self::lowerCamelStr(self::$route['action']) . 'Action';
                if(method_exists($cObj, $action)) {
                    $cObj->$action();
                    $cObj->getView();
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

    protected static function upperCamelStr($str)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
    }

    protected static function lowerCamelStr($str)
    {
        return lcfirst(self::upperCamelStr($str));
    }

    protected static function clearUrl($url)
    {
        $parts = explode('&', $url, 2);

        if($parts[0] == '') {
            return '';
        }

        if(false === strpos($parts[0], '=')) {
            return rtrim($parts[0], '/');
        } else {
            return '';
        }
    }
}