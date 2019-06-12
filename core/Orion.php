<?php

    use Core\Config;
    use Core\Database\MySQLDatabase;
    use Core\Router\Router;

    class Orion {

        private static $_instance;
        private $db_instance;
        private $_router;

        public static function getInstance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new Orion();
            }
            return self::$_instance;
        }

        public static function load() {
            session_start();
            require ROOT.'/app/Autoloader.php';
            App\Autoloader::register();
            require ROOT.'/core/Autoloader.php';
            Core\Autoloader::register();
        }

        public function getModel($name) {
            $class_name = '\\App\\Model\\'. ucfirst($name) . "Model";
            return new $class_name($this->getDb());
        }

        public function getDb() {
            $config = Config::getInstance(ROOT . '/config/config.php');
            if (is_null($this->db_instance)) {
                $this->db_instance = new MySQLDatabase($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
            }
            return $this->db_instance;
        }

        public function getRouter() {
            if (is_null($this->_router)) {
                $this->_router = new Router();
            }
            return $this->_router;
        }

    }