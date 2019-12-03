<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/');

require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

Router::add('post/add', ['controller' => 'Post', 'action' => 'add']);
Router::add('', ['controller' => 'Main', 'action' => 'index']);
Router::add('post', ['controller' => 'Post', 'action' => 'index']);

if(Router::matchRoutes($query)) {
    debug(Router::getRoute());
} else {
    echo '404';
}