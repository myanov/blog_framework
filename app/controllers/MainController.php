<?php


namespace app\controllers;


use app\models\Main;
use vendor\core\base\Model;
use vendor\core\App;

class MainController extends AppController
{
    public function indexAction()
    {
        $articles = App::$app->cache->get('articles');
        if(!$articles) {
            $articles = \R::findAll('articles');
            App::$app->cache->set('articles', $articles);
        }
        $menu = $this->menu;
        $title = 'Main';
        $this->set(compact('articles', 'title', 'menu'));
    }
}