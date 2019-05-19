<?php

    // Router

    require_once '../app/Router/Router.php';
    $router = new Router();
    require_once '../routes/web.php';



    // Views

    require_once '../app/View/View.php';
    $views = new View();



    if ($router->match("/".$_GET['url'])) {
        echo $router->call("/".$_GET['url']);
    } else {
        // 404
    }

?>