<?php

    namespace Core\Router;

    /**
     * Class Router
     * @package Core\Router
     */
    class Router {

        /**
         * Liste de toutes les routes
         */
        private $routes = [];

        /**
         * Liste de toutes les routes ayant un nom
         */
        private $namedRoutes = [];


        /**
         * Définir une route
         * @param Method Une des 5 méthodes HTTP, ou une liste de plusieurs méthodes HTTP séparée par un pipe (GET|POST|PATCH|PUT|DELETE).
         * @param Route Regex de la route. Un regex custom doit commencer par un '@'. Vous pouvez utiliser plusieurs regex pré-défini comme [i:id].
         * @param Target La cible de la route. Peut être un controller avec fonction ou une vue.
         * @param Name Facultatif - Nom de la route. Nécessaire pour appeler la route dans l'application.
         */
        public function add($method, $route, $target, $name = null) {

            if ($name) {
                if(isset($this->namedRoutes[$name])) {
                    throw new \Exception("Vous ne pouvez pas redéfinir la route '{$name}'");
                } else {
                    $this->namedRoutes[$name] = $route;
                    $this->routes[] = array("method" => $method, "route" => $route, "target" => $target, "name" => $name);
                }
            }
        }

        public function make($name) {
            if(isset($this->namedRoutes[$name])) {
                return $this->namedRoutes[$name];
            } else {
                return null;
            }
        }

        public function match($url) {
            $match = false;
            foreach ($this->routes as $route) {
                if ($route['route'] == $url) {
                    $match = array(
                        'method' => $route['method'],
                        'route' => $route['route'],
                        'target' => $route['target'],
                        'name' => $route['name']
                    );
                    break;
                }
            }
            return $match;
        }

    }