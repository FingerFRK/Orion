<?php

    use Core\Router\Router;

    define('ROOT', dirname(__DIR__));

    require ROOT . '/core/Orion.php';
    Orion::load();
    
    global $router;
    $router = new Router;
    require ROOT . '/routes/web.php';

    $match = $router->match($_SERVER['REQUEST_URI']);

    if(is_array($match) && is_callable($match['target'])) {
        call_user_func($match['target']);
    } else if (strpos($match['target'], '@') !== false) {
        list($_controller, $_function) = explode('@', $match['target']);
        $controller = 'App\\Controllers\\' . ucfirst($_controller);
        $controller = new $controller();
        $controller->$_function();
    } else if (file_exists(ROOT . '/views/' . $match['target'] . '.view.php')) {
        require ROOT . '/views/' . $match['target'] . '.view.php';
    } else {
        require ROOT . '/core/Views/404.view.php';
    }