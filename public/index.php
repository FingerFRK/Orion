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
        ob_start();
        require_once ROOT . '/views/404.view.php';
        $content = ob_get_clean();
        require ROOT . '/views/template.view.php';
    }
    
    // call_user_func_array($match['target'], $match['param']);
    // $match = $router->match(str_replace('/OrionGIT/public', '', $_SERVER['REQUEST_URI']));