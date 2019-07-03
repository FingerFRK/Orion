<?php

    namespace Core\Controller;

    class AbstractController {

        public function render($view, $params = []) {
            if (file_exists(ROOT . '/views/' . $view . '.view.php')) {
                ob_start();
                extract($params);
                require_once ROOT . '/views/' . $view . '.view.php';
                $content = ob_get_clean();
                require ROOT . '/views/template.view.php';
            } else {
                throw new Exception("Can not find the view");
            }
        }
        
    }
    