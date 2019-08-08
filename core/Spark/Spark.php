<?php

    namespace Core\Spark;

    class Spark {

        private $blocks = [];

        private $extend;

        private $override;
        
        public function block($title) {
            $this->blocks[] = [$title];
            ob_start();
        }
        
        public function endblock($title) {
            $this->blocks[$title] = ob_get_clean();
        }
        
        public function getBlockContent($title) {
            if (!is_null($this->blocks[$title])) {
                return $this->blocks[$title];
            } else {
                throw new \Exception("The content of the block '{$title}' is empty or not set");
            }
        }
        
        public function extends($template) {
            $_file = ROOT . '/views/' . $template . '.spark.php';
            if (file_exists($_file)) {
                $this->extend = $_file;
            }
        }

        public function override($template) {
            $_file = ROOT . '/core/Views/' . $template . '.spark.php';
            if (file_exists($_file)) {
                $this->override = $_file;
            }
        }
        
        public function render(string $template, array $params = []) {
            $_file = ROOT . '/views/' . $template . '.spark.php';
            if (file_exists($_file)) {
                extract($params);
                $content = file_get_contents($_file);
                eval(' ?>' . $content . '<?php ');
                if (!is_null($this->extend)) {
                    require $this->extend;
                }
                if (!is_null($this->override)) {
                    require $this->override;
                }
            } else {
                throw new \Exception("La vue '{$template}' est inaccessible ou non créée.");
            }
        }

        public function renderCore(string $template, array $params = []) {
            $_file = ROOT . '/core/Views/' . $template . '.spark.php';
            if (file_exists($_file)) {
                extract($params);
                $content = file_get_contents($_file);
                eval(' ?>' . $content . '<?php ');
                if (!is_null($this->extend)) {
                    require $this->extend;
                }
                if (!is_null($this->override)) {
                    require $this->override;
                }
            } else {
                throw new \Exception("La vue '{$template}' est inaccessible ou non créée.");
            }
        }
        
    }
    