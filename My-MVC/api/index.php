<?php

    define("__SITE_PATH", substr(realpath(dirname(__FILE__)), 0, strlen(realpath(dirname(__FILE__))) - 3));
    define("BASE_URL", 'http://localhost:8082/My-MVC/');
    // define("BASE_URL", 'https://admin.dqwatch.com/');
    include __SITE_PATH.'config.php';
    include __SITE_PATH . '/app/classes/' . 'Database.php';
	include __SITE_PATH . '/app/classes/' . 'Database_Base.php';
	include __SITE_PATH . '/includes/' . 'functions.php';
	 /*** include the router class ***/
	include __SITE_PATH. '/api/apiRoute.php';

	$db = Database::getInstance();
    $route = new apiRoute();
    $route->setPath(__SITE_PATH.'api');
    $route->loader();
?>