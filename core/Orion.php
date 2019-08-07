<?php

    use Core\Config\Config;
    use Core\Database\MySQLDatabase;

    /**
     * Class Orion
     */
    class Orion {

        /**
         * Instance de orion
         */
        private static $_instance;

        /**
         * Instance de orion
         */
        private static $_db_instance;
        
        /**
         * Permet de récupérer une instance de Orion si elle existe. Sinon, celle-ci sera créée
         * @return $_instance Retourne l'instance de Orion
         */
        public static function getInstance() {
            if (is_null(self::$_instance)) {
                self::$_instance = new Orion();
            }
            return self::$_instance;
        }

        /**
         * Ouvre la session & enregistre les classes du coeur d'Orion et de l'application
         */
        public static function load() {
            session_start();
            require ROOT . '/app/Autoloader.php';
            App\Autoloader::register();
            require ROOT . '/core/Autoloader.php';
            Core\Autoloader::register();
        }

        /**
         * Permet de récupérer une instance de la base de donnée si elle existe. Sinon, celle-ci sera créée
         * @return $_db_instance Retourne l'instance de la base de donnée
         */
        public function getDb() {
            $config = Config::getInstance(ROOT . '/config/config.php');
            if (is_null(self::$_db_instance)) {
                self::$_db_instance = new MySQLDatabase($config->get("db_name"), $config->get("db_user"), $config->get("db_pass"), $config->get("db_host"));
            }
            return self::$_db_instance;
        }

        public function getModel($model) {
            return new $model($this->getDb());
        }

    }
    