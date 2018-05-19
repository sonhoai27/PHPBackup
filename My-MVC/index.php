<?php

    $sitePath = realpath(dirname(__FILE__));
    define("__SITE_PATH", $sitePath);
    define("BASE_URL", 'http://localhost:8082/My-MVC/');
    // define("BASE_URL", 'https://admin.dqwatch.com/');
    include 'config.php';
    include 'includes/init.php';
    $route = new Route();
    $route->setPath(__SITE_PATH.'\app\controllers');
    $route->loader();
?>
