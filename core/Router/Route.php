<?php

    namespace Core\Router;

    class Route {

        private $route;
        private $call;
        private $name;
        private $params = [];

        public function add($route, $call) {
            if (is_string($route) && is_string($call)) {
                $this->route = $route;
                $this->call = $call;
            }
            return $this;
        }

        public function name($name) {
            if (is_string($name)) {
                $this->name = $name;
            }
        }

    }