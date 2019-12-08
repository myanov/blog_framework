<?php


namespace vendor\core;


class Registry
{
    private static $container = [];
    private static $instance;

    private function __construct()
    {
        $config = require ROOT . '/config/config.php';
        foreach($config['components'] as $name => $object) {
            self::$container[$name] = new $object;
        }
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function instance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __get($name)
    {
        if(isset(self::$container[$name]) && is_object(self::$container[$name])) {
            return self::$container[$name];
        }
    }

    public function __set($name, $value)
    {
        if(!isset(self::$container[$name])) {
            self::$container[$name] = new $value;
        }
    }
}