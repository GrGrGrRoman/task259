<?php

namespace App\core;

class View
{
    public $path;
    public $route;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }
    
    public function render($title , $viewArr = [])
    {     
        extract($viewArr);

        $path = VIEW . $this->path. '.phtml';

        if (file_exists($path))
        {
        ob_start();
        require_once $path;
        $content = ob_get_clean();
        require_once VIEW . 'layouts' . DIRECTORY_SEPARATOR . $this->layout . '.phtml';
        }
    }
    
    public function redirect($url)
    {
        header('location: /'.$url);
        exit;
    }

    public static function errorCode($code)
    {
        http_response_code($code);
        $path = VIEW . 'errors' . DIRECTORY_SEPARATOR . $code . '.phtml';
        if (file_exists($path))
        {
            require_once $path;
        }        
        exit;
    }
}
