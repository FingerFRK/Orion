<?php

    namespace Core\Model;

    use Core\Database\Database;

    class Model {

        protected $model;
        protected $db;

        public function __construct(Database $db) {
            $this->db = $db;
            if (is_null($this->model)) {
                $parts = explode("\\", get_class($this));
                $class_name = end($parts);
                $this->model = strtolower(str_replace('Model', '', $class_name));
            }
        }
        
        public function all() {
            return $this->query("SELECT * FROM " . $this->model);
        }

        public function find($id) {
            return $this->query("SELECT * FROM {$this->model} WHERE id = ?", [$id], true);
        }

        public function query($statement, $params = [], $one = false) {
            if ($params) {
                return $this->db->prepare($statement, $params, str_replace('Model', 'Entity', get_class($this)), $one);
            } else {
                return $this->db->query($statement, str_replace('Model', 'Entity', get_class($this)), $one);
            }
        }
        
    }