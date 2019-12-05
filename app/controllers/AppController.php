<?php


namespace app\controllers;


use vendor\core\base\Controller;
use vendor\core\base\Model;

class AppController extends Controller
{
    public $menu;

    public function __construct($route)
    {
        parent::__construct($route);
        new Model();
        $this->menu = \R::findAll('articles_categories');
    }
}