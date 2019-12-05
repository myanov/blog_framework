<?php


namespace app\controllers;


use app\models\Main;
use vendor\core\base\Model;

class MainController extends AppController
{
    public function indexAction()
    {
        $mObj = new Main();
        $articles = $mObj->findAll();
        $title = 'Main';
        $this->set(compact('articles', 'title'));
    }
}