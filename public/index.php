<?php

    define('ROOT', dirname(__DIR__));

    require ROOT.'/core/Orion.php';
    Orion::load();

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "home";
    }

    ob_start();
    switch ($page) {
        case 'home':
            require ROOT . '/views/front/index.view.php';
            break;
        case 'user':
            require ROOT . '/views/front/users.view.php';
            break;
        
    }
    $content = ob_get_clean();

    require ROOT . '/views/template.view.php';