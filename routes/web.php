<?php

    $router->add("/", "FrontController@index", "accueil");
    $router->add("/about", "FrontController@about", "a-propos");

?>