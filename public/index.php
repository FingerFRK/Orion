<?php

    use Core\Router\Router;

    define('ROOT', dirname(__DIR__));

    require ROOT.'/core/Orion.php';
    Orion::load();

    $router = new Router();

    require ROOT.'/routes/web.php';
    
    $match = $router->match(str_replace('/OrionGIT/public', '', $_SERVER['REQUEST_URI']));
    
    if (is_array($match)) {
        ob_start();
        if (is_callable($match['target'])) {
            call_user_func_array($match['target'], $match['param']);
        } else {
            $params = $match['params'];
            require ROOT . '/views/front/'.$match['target'].'.view.php';
        }
        $content = ob_get_clean();
        require ROOT . '/views/template.view.php';
    } else {
        ob_start();
        require ROOT . '/views/404.view.php';
        $content = ob_get_clean();
        require ROOT . '/views/template.view.php';
    }