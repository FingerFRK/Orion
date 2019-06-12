<?php

    class FrontController {

        public function index() {
            global $views;
            return $views->make('index');
        }

    }

?>