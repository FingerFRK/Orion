<?php

    $router->add("/", "FrontController@index", "home");
    $router->add("/about", "FrontController@about", "about");

?>