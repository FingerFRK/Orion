<?php

    use Core\Router\Router;
use Core\Spark\Spark;

define('ROOT', dirname(__DIR__));

    require ROOT . '/core/Orion.php';
    Orion::load();
    
    global $router;
    $router = new Router;
    require ROOT . '/routes/web.php';

    $match = $router->match($_SERVER['REQUEST_URI']);

    if(is_array($match) && is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']); 
    } else if (strpos($match['target'], '@') !== false) {
        list($_controller, $_function) = explode('@', $match['target']);

        $controller = 'App\\Controllers\\' . ucfirst($_controller);
        $controller = new $controller();
        
        call_user_func_array(array($controller, $_function), $match['params']);
    } else if (file_exists(ROOT . '/views/' . $match['target'] . '.spark.php')) {
        extract($match['params']);
        require ROOT . '/views/' . $match['target'] . '.spark.php';
    } else {
        $spark = new Spark();
        $spark->renderCore('404');
        require ROOT . '/core/Views/404.spark.php';
    }