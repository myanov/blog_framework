<?php

return [
    'dsn' => 'mysql:host=localhost;dbname=test_blog;charset=utf8',
    'username' => 'root',
    'password' => 'root',
    'opt' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];