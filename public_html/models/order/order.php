<?php
    ob_start();
    require_once("./models/dbcon.php");
    class M_Order {
        private $db = NULL;
        function __construct(){
            $this->db = new ConnectDB();
            // $this->db->connectdb();
        }

        public function Update_Order(){

        }

        public function Delete_Order($id){
            $sql = "delete from my_order where id_order = '$id'";
            if($this->db->query($sql) == true){
                $url_dir = "./admin?a=order";
                $_SESSION['detele_order_success'] = "Xóa thành công";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
            $this->db->disconnectdb();
        }


        public function CountRow(){
            $sql = "select * from my_order";
            $this->db->query($sql);
            $sum_watch = $this->db->num_rows();
            return  $sum_watch."";
            $this->db->disconnectdb();
        }
        public function CountRow_uncheck(){
            $sql = "select * from my_order where status_order = 0";
            $this->db->query($sql);
            $sum_watch = $this->db->num_rows();
            return  $sum_watch."";
            $this->db->disconnectdb();
        }
         public function CountRow_checked(){
            $sql = "select * from my_order where status_order = 1";
            $this->db->query($sql);
            $sum_watch = $this->db->num_rows();
            return  $sum_watch."";
            $this->db->disconnectdb();
        }
        public function GetSomeOrder(
            $pg = 0,
            $filter = "DESC",
            $where = ""
            ){
            $sql = "SELECT *
                    FROM my_order
                    $where
                    ORDER BY id_order $filter
                    LIMIT $pg, 8";
            $this->db->query($sql);
            $order = $this->db->fetch();
            $num_rows = $this->db->num_rows_query("SELECT *
                    FROM my_order
                    $where
                    ORDER BY id_order $filter");
            $arr = array();
            $arr['list_order'] = $order;
            $arr['num_rows'] = $num_rows;
            return $arr;
            $this->db->disconnectdb();
        }
        public function GetOneOrder($id){
            $sql = "SELECT * FROM my_order where id_order = '$id' ORDER BY id_order";
            $this->db->query($sql);
            $datarow = $this->db->fetch();
            return $datarow;
            $this->db->disconnectdb();
        }
        public function GetPrdOrder($id){
            $sql = "SELECT * FROM product_of_order WHERE id_order = '$id' ORDER BY id_order";
            $this->db->query($sql);
            $datarow = $this->db->fetch();
            return $datarow;
            $this->db->disconnectdb();
        }
        public function Confirm_Order($id){
            $sql = "UPDATE `my_order` SET status_order = 1 where id_order = '$id' ";
            if($this->db->query($sql) == true){
                $_SESSION['confirm_order_success'] = "thành công";
               $url_dir = "./admin?a=order&pages=detail&dir=order&id=$id";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
            $this->db->disconnectdb();
        }
        public function Un_Confirm_Order($id){
            $sql = "UPDATE `my_order` SET status_order = 0 where id_order = '$id' ";
            if($this->db->query($sql) == true){
                $_SESSION['un_confirm_order_success'] = "thành công";
               $url_dir = "./admin?a=order&pages=detail&dir=order&id=$id";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
            $this->db->disconnectdb();
        }
        public function AddToOrder($payemnt, $address, $email, $name, $phone, $total){
            $sql = "INSERT INTO my_order (email_buyer, number_buyer, name_buyer, address_buyer, payment_order, total_order)
                VALUES ('$email', '$phone', '$name', '$address', '$payemnt', '$total')";
            $id = $this->db->query_return_id($sql);
            return $id;
            $this->db->disconnectdb();
        }

        public function AddProductOrder($dem, $id, $name_prd, $price_prd, $qty_prd, $img_prd, $id_prd){
            $sql = "INSERT INTO `product_of_order`(`id_order`, `name_watch`, `price_watch_off`, `qty_watch`, `img_watch`, `id_watch`)
            VALUES ('$id','$name_prd',' $price_prd', '$qty_prd', '$img_prd', '$id_prd')";

            if($this->db->query($sql) == true){
                $dem--;
            }else{
                echo "LOI";
            }

            if($dem == 0){
               $this->db->disconnectdb();
            }
        }

        public function ShowAllOrder(){
            $sql = 'select * from my_order order by id_order desc';
            $this->db->query($sql);
            $my_order = $this->db->fetch();
            return $my_order;
            $this->db->disconnectdb();
        }

        public function GetSomeContact(
            $pg = 0,
            $filter = "DESC",
            $where = ""
            ){
          $sql = "select * from contact_us $where ORDER by id_contact_us $filter LIMIT $pg, 8";
          $this->db->query($sql);
          $contacts = $this->db->fetch();
          $num_rows = $this->db->num_rows_query("select * from contact_us $where ORDER by id_contact_us $filter");
          $arr = array();
          $arr['list_contacts'] = $contacts;
          $arr['num_rows'] = $num_rows;
          return $arr;
          $this->db->disconnectdb();
        }
        public function GetOneContact($id){
          $sql = "select * from contact_us where id_contact_us = $id";
          $this->db->query($sql);
          $contacts = $this->db->fetch();
          return $contacts['0'];
          $this->db->disconnectdb();
        }
        public function Confirm_Contact($id){
          $sql = "UPDATE `contact_us` SET 	viewed_contact_us = 1 where id_contact_us = '$id' ";
          if($this->db->query($sql) == true){
              $_SESSION['confirm_contact_success'] = "thành công";
             $url_dir = "./admin?a=order&pages=detail&dir=contact&id=$id";
              if (headers_sent()) {
                  die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
              }
              else{
                  exit(header("Location: $url_dir"));
              }
          }
          $this->db->disconnectdb();
        }
        public function Un_Confirm_Contact($id){
            $sql = "UPDATE `contact_us` SET viewed_contact_us = 0 where id_contact_us = '$id' ";
            if($this->db->query($sql) == true){
                $_SESSION['un_confirm_contact_success'] = "thành công";
               $url_dir = "./admin?a=order&pages=detail&dir=contact&id=$id";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
            $this->db->disconnectdb();
        }
        public function Delete_Contact($id){
            $sql = "delete from contact_us where id_contact_us = '$id'";
            if($this->db->query($sql) == true){
                $url_dir = "./admin?a=order&pages=contacts";
                $_SESSION['detele_contact_success'] = "Xóa thành công";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
            $this->db->disconnectdb();
        }
        public function GetAllOrderNotOrCheck($pg = 0, $on_off){
          $sql = "select * from my_order where status_order = $on_off order by id_order desc";
          $this->db->query($sql);
          $list_order = $this->db->fetch();
          return $list_order;
          $this->db->disconnectdb();
        }
        public function GetAllContactNotOrCheck($pg = 0, $on_off){
          $sql = "select * from contact_us where viewed_contact_us = $on_off order by id_ccontact_us DESC";
          $this->db->query($sql);
          $list_contact = $this->db->fetch();
          return $list_contact;
          $this->db->disconnectdb();
        }
    }
    ob_end_flush();
?>
