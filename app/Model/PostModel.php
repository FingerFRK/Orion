<?php

    namespace App\Model;

    use Core\Model\Model;

    class PostModel extends Model {
        
        public function getDate($id) {
            return $this->query("SELECT date FROM {$this->model} WHERE id = ?", [$id], true);
        }

    }