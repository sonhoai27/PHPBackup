<?php
require_once ("dbcon.php");
class Help_Model extends ConnectDB {
    public function Add_To_Contact($email_phone, $name_cus, $info, $id_prd){
        $sql = "Insert into contact_us (email_phone_contact_us, name_cus_contact_us, info_contact_us, id_prd)
                VALUES ('$email_phone', '$name_cus', '$info', $id_prd)";
        if($this->query($sql)){
            return true;
            $this->disconnectdb();
        }else{
            return false;
        }
    }
}
?>