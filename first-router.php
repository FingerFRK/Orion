<?php

    class Router {
        
        private $routes = [];

        public function add($route, $call, $name = null) {
            global $routes;
            $routes[] = array("route" => $route, "call" => $call, "name" => $name);
        }

        public function getRouteAttribute($url, $attr) {
            global $routes;

            foreach ($routes as $route) {
                if ($route['route'] == $url) {
                    return $route[$attr];
                    break;
                }
            }
        }

        public function match($url) {
            global $routes;
            $match = false;
            foreach ($routes as $route) {
                if ($route['route'] == $url) {
                    $match = true;
                    break;
                }
            }
            return $match;
        }

        public function call($url) {
            $call = $this->getRouteAttribute($url, 'call');

            $call = explode("@", $call);
            list($controller, $function) = $call;
            require_once '../controllers/' . $controller . ".php";
            $control = new $controller();
            $control->$function();
        }

    }

?>