<?php
    ob_start();
    require_once("./models/dbcon.php");
    class Brand {
        private $db = NULL;
        public function __construct(){
            $this->db = new ConnectDB();
            // $this->db->connectdb();
        }
        public function GetAllBrand(){
            $sql = "select * from brand order by id_brand DESC";
            $this->db->query($sql);
            $datarow = $this->db->fetch();
            return $datarow;
            $this->db->disconnectdb();
        }
        public function Pagination_Get_Brand($num_page){
            $sql = "select * from brand order by id_brand DESC limit $num_page,4";
            $this->db->query($sql);
            $datarow = $this->db->fetch();
            return $datarow;
            $this->db->disconnectdb();
        }
        public function Add_New_Brand($name, $alias){
            $sql = "INSERT INTO `brand`(`name_brand`, `alias_brand`) VALUES ('$name', '$alias')";
            $last_id = $this->db->query_return_id($sql);
            if($last_id != false){
                return $last_id;
            }
            $this->db->disconnectdb();
        }
        public function GetOneBrand($id){
            $sql = "select * from brand where id_brand = '$id'";
            if($this->db->query($sql)){
                $data_row = $this->db->fetch();
                return $data_row[0];
                $this->db->disconnectdb();
            }
        }
        public function DeleteBrand($arr_brand){
            $arr = array();
            $arr = explode(",",$arr_brand);
            $finished = false;
            for($i = 0; $i < count($arr); $i++){
                $id = $arr[$i];
                $sql = "DELETE FROM `brand` WHERE id_brand = '$id'";
                if($this->db->query($sql) == true){
                    $finished = true;
                }
            }
            if($finished){
                $this->db->disconnectdb();
                $_SESSION['delete_success'] = "OK";
                $url_dir = "./admin?a=settings";
                if (headers_sent()) {
                    die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
                }
                else{
                    exit(header("Location: $url_dir"));
                }
            }
        }
        public function GetRandomBrands(){
            $sql = "select alias_brand, name_brand from brand, watch where id_brand = brand_id order by RAND() limit 5";
            if($this->db->query($sql)){
                $data_row = $this->db->fetch();
                return $data_row;
                $this->db->disconnectdb();
            }
        }
    }
    ob_end_flush();
?>
