<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Post extends App
{
    public function showAction()
    {
        $this->layout = false;
    }

    public function indexAction()
    {
//        $this->layout = 'test';
//        $this->view = 'test';
        $name = 'Andrei';
        $title = 'Home';
        $this->set(compact('name', 'title'));
    }
}