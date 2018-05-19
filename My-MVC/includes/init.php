<?php

 /*** include the model class ***/
include __SITE_PATH . '/app/classes/' . 'Database.php';
include __SITE_PATH . '/app/classes/' . 'Database_Base.php';
 /*** include the controller class ***/
include __SITE_PATH . '/app/classes/' . 'Controller_Base.php';
 
 /*** include the template class ***/
include __SITE_PATH . '/app/classes/' . 'View_Base.php';
include __SITE_PATH . '/includes/' . 'functions.php';
 /*** include the router class ***/
include __SITE_PATH . '/app/classes/' . 'Route.php';
$db = Database::getInstance();
?>