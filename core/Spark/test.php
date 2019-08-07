<?php

    public function render($view, $params = []) {
        if (file_exists(ROOT . '/views/' . $view . '.view.php')) {
            $content = file_get_contents(ROOT . '/views/' . $view . '.view.php');

            $content = preg_replace('/\{{foreach (.*)\}}/', '<?php foreach($1): ?>', $content);
            $content = preg_replace('/\{{endforeach\}}/', '<?php endforeach; ?>', $content);
            
            foreach ($params as $key => $value) {
                // $content = preg_replace('/\{{\s?' . $key . '\s?}}/', $value, $content);
                $content = preg_replace('/\{{' . $key . '\}}/', $value, $content);
            }

            eval(' ?>' . $content . '<?php ');
        } else {
            throw new \Exception("La vue '{$view}' est introuvable"); 
        }
    }