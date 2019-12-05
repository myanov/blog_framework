<?php


namespace vendor\core;


class DB
{
    protected $pdo;
    protected static $instance;
    public static $countSql;
    public static $allSql = [];

    protected function __construct()
    {
        $db = require ROOT . '/config/config_db.php';
        require LIBS . '/rb.php';
        \R::setup($db['dsn'], $db['username'], $db['password']);
        \R::freeze(true);
//        $db = require ROOT . '/config/config_db.php';
//        $this->pdo = new \PDO($db['dsn'], $db['username'], $db['password'], $db['opt']);
    }

    public static function instance()
    {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

//    public function execute($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$allSql[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        return $stmt->execute($params);
//    }
//
//    public function query($sql, $params = [])
//    {
//        self::$countSql++;
//        self::$allSql[] = $sql;
//        $stmt = $this->pdo->prepare($sql);
//        $stmt->execute($params);
//        return $stmt->fetchAll();
//    }
}