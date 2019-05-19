<?php

    // Views
    require_once '../app/View/View.php';
    $views = new View();

    // Router
    require_once '../app/Router/Router.php';
    $router = new Router();
    require_once '../routes/web.php';

    // Work
    if ($router->match($_SERVER['REQUEST_URI'])) {
        echo $router->call($_SERVER['REQUEST_URI']);
    } else {
        $views->make('404');
    }

?>