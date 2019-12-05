<?php


namespace app\controllers;


use app\models\Main;
use vendor\core\base\Model;

class MainController extends AppController
{
    public function indexAction()
    {
        $articles = \R::findAll('articles');
        $menu = $this->menu;
        $title = 'Main';
        $this->set(compact('articles', 'title', 'menu'));
    }
}