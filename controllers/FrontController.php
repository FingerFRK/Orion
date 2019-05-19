<?php

    class FrontController {

        public function index() {
            // return $views->make('index');
            include '../views/index.view.php';
        }

        public function about() {
            include '../views/about.view.php';
        }

    }

?>