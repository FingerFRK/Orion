<?php

    namespace Core\Router;

    use App\Controllers;

    class Router {
        
        private $routes = [];

        private $namedRoutes = [];


        /**
         * Add route to the router
         * 
         * @param string $method
         * @param string $route
         * @param string $call
         * @param string $name
         * @throws Exception
         * 
         */
        public function add($method, $route, $call, $name = null) {

            $this->routes[] = array("method" => $method, "route" => $route, "call" => $call, "name" => $name);

            if (!is_null($name)) {
                if (isset($this->namedRoutes[$name])) {
                    throw new \Exception("Can not redeclare route '{$name}'");
                } else {
                    $this->namedRoutes[$name] = $route;
                }
            }

            return;
        }

        public function getRouteAttribute($url, $attr) {
            foreach ($this->routes as $route) {
                if ($route['route'] == $url) {
                    return $route[$attr];
                    break;
                }
            }
        }

        public function match($url) {
            $match = false;
            foreach ($this->routes as $route) {
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
            $_controller = $call[0];
            $_function = $call[1];
            $controller = 'App\\Controllers\\' . ucfirst($_controller);
            $controller = new $controller();
            $controller->$_function();
        }

    }

?>