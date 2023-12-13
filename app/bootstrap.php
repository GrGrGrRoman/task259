<?php

namespace App;

session_start();

use App\config\Db;
use App\core\Router;

require_once 'config' . DIRECTORY_SEPARATOR . 'config.php';

// отладка
function d($str)
{
    echo '<pre>';
    var_dump($str);
    echo '</pre>';
}

//автозагрузчик классов
spl_autoload_register(function($class)
{
    $path = str_replace('\\', '/', $class . '.php');

    if(file_exists($path)) {
        require_once $path;
    }
});

//$pdo = new Db();
// проверка соединения с БД
/* if ($pdo != null)
  echo 'Соединение с БД установлено!';
else
  echo 'Нет соединения с БД!'; */

$router = new Router;
$router->start();