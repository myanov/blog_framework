<?php


namespace app\controllers;


use vendor\core\App;
use vendor\core\base\View;

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
        View::setMeta('Главная страница', 'Описание', 'Ключевые слова');
        $this->set(compact('articles', 'menu'));
    }
}