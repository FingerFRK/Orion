<?php

    namespace App\Controllers;

    use Core\Controller\AbstractController;

    class FrontController extends AbstractController {
        
        public function index() {
            return $this->render('front/index');
        }

    }