<?php

namespace app\controllers;

use vendor\core\base\Controller;

class Post extends Controller
{
    public function showAction()
    {
        echo "Post::show";
    }

    public function indexAction()
    {
        echo "Post::index";
    }
}