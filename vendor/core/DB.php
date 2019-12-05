<?php


namespace vendor\core;


class DB
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        $this->pdo = new \PDO($db['dsn'], $db['username'], $db['password'], $db['opt']);
    }

    public static function instance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function execute($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute();
    }

    public function query($sql)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}