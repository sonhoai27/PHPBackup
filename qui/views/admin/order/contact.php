<?php
class Contact_View
{
  public function Main_Contact_View($list_arr = array()){
    require_once("./theme/admin/order/contact.php");
  }
  public function Contact_Detail($contact_detail){
    require_once("./theme/admin/order/contact_detail.php");
  }
}
?>
