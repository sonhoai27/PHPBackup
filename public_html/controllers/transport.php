<?php
class Transport_Controller{
    public function Main_Transport(){
        require_once ('./views/transport.php');
        $view = new Transport_View();
        $view->Main_Transport();
    }
}
?>