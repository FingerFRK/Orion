<?php

    namespace Core\Database;

    use \PDO;

    class MySQLDatabase extends Database {

        private $db_name;
        private $db_user;
        private $db_pass;
        private $db_host;
        private $db;

        public function __construct($db_name, $db_user = 'root', $db_pass = '', $db_host = 'localhost') {
            $this->db_name = $db_name;
            $this->db_user = $db_user;
            $this->db_pass = $db_pass;
            $this->db_host = $db_host;
        }

        private function getDb() {
            if ($this->db === null) {
                $db = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $db;
            }
            return $this->db;
        }

        public function query($statement, $class_name = null, $one = false) {
            $request = $this->getDb()->query($statement);
            if($class_name === null) {
                $request->setFetchMode(PDO::FETCH_OBJ);
            } else {
                $request->setFetchMode(PDO::FETCH_CLASS, $class_name);
            }
            if ($one) {
                $datas = $request->fetch();
            } else {
                $datas = $request->fetchAll();
            }
            return $datas;
        }

        public function prepare($statement, $params, $class_name, $one = false) {
            $request = $this->getDb()->prepare($statement);
            $request->execute($params);
            $request->setFetchMode(PDO::FETCH_CLASS, $class_name);
            if ($one) {
                $datas = $request->fetch();
            } else {
                $datas = $request->fetchAll();
            }
            return $datas;
        }

    }