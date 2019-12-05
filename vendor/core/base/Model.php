<?php


namespace vendor\core\base;


use vendor\core\DB;

class Model
{
    public $table;
    public $pdo;
    public $field = 'id';

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

    public function findOne($value, $field = '')
    {
        $field = $field ?: $this->field;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ?";
        return $this->pdo->query($sql, [$value]);
    }

    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findLike($str, $field, $table = '')
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM {$this->table} WHERE $field LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }
}