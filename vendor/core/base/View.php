<?php


namespace vendor\core\base;


class View
{
    public $route = [];
    public $view;
    public $layout;
    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        $this->view = $view;
        if(false !== $layout) {
            $this->layout = $layout ?: LAYOUT;
        } else {
            $this->layout = false;
        }

    }

    public function render(array $arr)
    {
        $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
        extract($arr);
        ob_start();
        if(is_file($file_view)) {
            require $file_view;
        } else {
            echo "View <b>$file_view</b> not was found";
        }
        $content = ob_get_clean();

        if ($this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($file_layout)) {
                require $file_layout;
            } else {
                echo "Layout <b>$file_layout</b> not was found";
            }
        }
    }

    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }

    public static function getMeta()
    {
        echo '<title>'. self::$meta['title'] .'</title>
        <meta name="description" content="'. self::$meta['desc'] .'">
        <meta name="keywords" content="'. self::$meta['keywords'] .'">';
    }
}