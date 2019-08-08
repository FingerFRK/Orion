<?php

    namespace Core\Router;

    /**
     * Class Router
     * @package Core\Router
     */
    class Router {

        /**
         * @var array Tableau de toutes les routes
         */
        private $routes = [];

        /**
         * @var array Tableau de toutes les routes renommées
         */
        private $namedRoutes = [];

        /**
         * @var array Tableau des match par défaut (regex helpers)
         */
        protected $matchTypes = array(
            'i'  => '[0-9]++',
            'a'  => '[0-9A-Za-z]++',
            'h'  => '[0-9A-Fa-f]++',
            '*'  => '.+?',
            '**' => '.++',
            ''   => '[^/\.]++'
        );


        /**
         * Retourne toutes les routes
         * Utile si vous voulez afficher la liste de toutes vos routes
         * @return array Toute les routes.
         */
        public function getRoutes() {
            return $this->routes;
        }

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
                    $this->routes[] = array($method, $route, $target, $name);
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

        public function match($requestUrl = null, $requestMethod = null) {

            $params = [];
            $match = false;

            // set Request Url if it isn't passed as parameter
            if($requestUrl === null) {
                $requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
            }

            // set Request Method if it isn't passed as a parameter
            if($requestMethod === null) {
                $requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
            }

            foreach ($this->routes as $handler) {

                list($methods, $route, $target, $name) = $handler;
                
                $method_match = (stripos($methods, $requestMethod) !== false);

                if (!$method_match) continue;

                if ($route === '*') {
                    $match = true;
                } else if (isset($route[0]) && $route[0] === '@') {
                    $pattern = '`' . substr($route, 1) . '`u';
                    $match = preg_match($pattern, $requestUrl, $params) === 1;
                } elseif (($position = strpos($route, '[')) === false) {
                    $match = strcmp($requestUrl, $route) === 0;
                } else {
                    // Compare longest non-param string with url
                    if (strncmp($requestUrl, $route, $position) !== 0) {
                        continue;
                    }
                    $regex = $this->compileRoute($route);
                    $match = preg_match($regex, $requestUrl, $params) === 1;
                }

                if ($match) {

                    if ($params) {
                        foreach ($params as $key => $value) {
                            if (is_numeric($key)) unset($params[$key]);
                        }
                    }

                    return array(
                        'method' => $methods,
                        'route' => $route,
                        'target' => $target,
                        'name' => $name,
                        'params' => $params
                    );
                }
            }
            return false;
        }

        /**
         * Compile the regex for a given route (EXPENSIVE)
         */
        protected function compileRoute($route) {
            if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

                $matchTypes = $this->matchTypes;
                foreach($matches as $match) {
                    list($block, $pre, $type, $param, $optional) = $match;

                    if (isset($matchTypes[$type])) {
                        $type = $matchTypes[$type];
                    }
                    if ($pre === '.') {
                        $pre = '\.';
                    }

                    $optional = $optional !== '' ? '?' : null;
                    
                    //Older versions of PCRE require the 'P' in (?P<named>)
                    $pattern = '(?:'
                            . ($pre !== '' ? $pre : null)
                            . '('
                            . ($param !== '' ? "?P<$param>" : null)
                            . $type
                            . ')'
                            . $optional
                            . ')'
                            . $optional;

                    $route = str_replace($block, $pattern, $route);
                }

            }
            return "`^$route$`u";
        }

    }