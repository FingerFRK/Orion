<?php

    namespace Core\Config;


    /**
     * Class Config
     * @package Core\Config
     */
    class Config {

        /**
         * Instance de la configuration
         */
        private static $_instance;

        /**
         * Tableau des paramètres de la configuration
         */
        private $settings = [];

        
        /**
         * Permet de récupérer une instance de la configuration si elle existe sinon, celle-ci sera créée
         * @return $_instance Retourner l'instance de la configuration
         */
        public static function getInstance($file) {
            if (is_null(self::$_instance)) {
                self::$_instance = new Config($file);
            }
            return self::$_instance;
        }

        /**
         * Permet de remplir le tableau des paramètres de la configuration via un require sur le fichier de configuration
         */
        public function __construct($file) {
            $this->settings = require($file);
        }

        /**
         * Permet de récupérer une information dans le tableau des paramètres de la configuration
         * @param $key Clé de l'information à récupérer dans le tableau
         * @return Information Retourner l'information demandée
         */
        public function get($key) {
            if (!isset($this->settings[$key])) {
                return null;
            }
            return $this->settings[$key];
        }

    }