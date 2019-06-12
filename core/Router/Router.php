<?php

    namespace Core\Router;

    class Router {

        private $routes = [];

        public static function load() {
            $this->routes = require(ROOT . '/routes/web.php');
        }

    }