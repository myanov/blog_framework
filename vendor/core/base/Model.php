<?php


namespace vendor\core\base;


use vendor\core\DB;

class Model
{
    public $table;
    public $pdo;

    public function __construct()
    {
        $this->pdo = DB::instance();
    }

    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }
}