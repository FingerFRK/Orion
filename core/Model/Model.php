<?php

    namespace Core\Model;

    use Core\Database\Database;

    /**
     * Class Orion
     * @package Core\Model
     */
    class Model {

        /**
         * Nom de la table dans la base de donnée
         */
        protected $model;

        /**
         * Stockage de la base de donnée
         */
        protected $db;


        /**
         * Construction de la classe
         * @param $db Stock la base de donnée afin de pouvoir éxecuter des requêtes
         */
        public function __construct(Database $db) {
            $this->db = $db;
            if (is_null($this->model)) {
                $parts = explode("\\", get_class($this));
                $class_name = end($parts);
                $this->model = strtolower(str_replace('Model', '', $class_name)).'s';
            }
        }
        
        /**
         * Récupère tous les éléments de la table liée au model
         * @return All Retourne tous les éléments de la table liée au model
         */
        public function findAll() {
            return $this->query("SELECT * FROM {$this->model}", true);
        }

        /**
         * Récupère un élément par son Id
         * @return findById Retourne l'élément récupérer par son Id
         */
        public function findById($id) {
            return $this->query("SELECT * FROM {$this->model} WHERE id = ?", true, [$id], true);
        }

        /**
         * Requête globale entre le query et le prepare
         * @param Statement Requête préparée ou non
         * @param Params[] Paramètres de la requête (facultatif)
         * @param One Retourne un ou plusieurs éléments
         * @return Requete Retourne le résultat de la requête
         */
        public function query($statement, $fetch = false, $params = [], $one = false) {
            if ($params) {
                return $this->db->prepare($statement, $params, str_replace('Model', 'Entity', get_class($this)), $one, $fetch);
            } else {
                return $this->db->query($statement, str_replace('Model', 'Entity', get_class($this)), $one, $fetch);
            }
        }
        
    }