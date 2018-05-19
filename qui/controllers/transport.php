<?php
require_once("./models/trans.php");
class Transport_Controller extends Model_Trans{
    public function Main_Transport(){
        require_once ('./views/transport.php');
        $view = new Transport_View();
        $view->Main_Transport();
    }
    public function Add_Trans(){
      if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
        $data = array();
        $name = $_POST['ouName'];
        $email = $_POST['ouEmail'];
        $phone = $_POST['ouPhone'];
        $link = $_POST['ouLink'];
        $qty = $_POST['ouQty'];
        $data['name'] = $name;
        $data['email'] = $email;
        $data['phone'] = $phone;
        $data['link'] = $link;
        $data['qty'] = $qty;
        
        $this->AddModelTrans($data);
      }
    }
}
?>