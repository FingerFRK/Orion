<?php

    namespace Core\Controller;

    use Core\Spark\Spark;

    class AbstractController {

        public function render($view, $params = []) {
            $spark = new Spark();
            $spark->render($view, $params);
        }
        
    }
    