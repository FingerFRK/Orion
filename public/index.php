<?php
use Core\Router\Router;

define('ROOT', dirname(__DIR__));

    require ROOT.'/core/Orion.php';
    Orion::load();

    $router = new Router();

    require ROOT . '/routes/web.php';

    if ($router->match($_SERVER['REQUEST_URI'])) {
        $router->call($_SERVER['REQUEST_URI']);
    } else {
        echo "false";
    }
    
    // call_user_func_array($match['target'], $match['param']);
    // $match = $router->match(str_replace('/OrionGIT/public', '', $_SERVER['REQUEST_URI']));