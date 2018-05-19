<?php
require_once ("./models/help.php");
class Help_Controller{
    public function Main_Help_Controller(){
        require_once ("./views/help.php");
        $view_help = new Help_View();
        $view_help->Main_Help_View();
    }
    public function Add_To_Contact($arr = array()){
        $help = new Help_Model();
        $email = $arr['email'];
        $info = Addslashes($arr['info']);
        $name = $arr['name'];
        $id_prd = $arr['id_prd'];
        return $help->Add_To_Contact($email, $name, $info, $id_prd);
    }
}
?>