<?php

    class View {
        
        public function make($view) {
            echo file_get_contents('../views/' . $view . '.view.php');
        }

    }

?>