<?php

    class FrontController {

        public function index() {
            global $views;
            return $views->make('index');
        }

        public function about() {
            global $views;
            return $views->make('about');
        }

    }

?>