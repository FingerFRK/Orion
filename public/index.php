<?php

    define('ROOT', dirname(__DIR__));

    require ROOT.'/core/Orion.php';
    Orion::load();

    Orion::getInstance()->getRouter()->load();