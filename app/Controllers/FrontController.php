<?php

    namespace App\Controllers;

    use Core\Controller\AbstractController;

    class FrontController extends AbstractController {
        
        public function index() {
            $this->render('Override/index', [
                'title' => "Orion",
                'subtitle' => "Propulsé par Spark & Phobos."
            ]);
        }

    }