<?php
class Login_Controller
{
  public function Main_Login()
  {
    require_once("./views/admin/login.php");
    $login = new Login_View();
    $login->Login_Main();
  }
  public function Logout(){
    unset($_SESSION['login']);
    header("Location: ./admin");
  }
}

 ?>
