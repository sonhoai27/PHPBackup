<?php
    require_once("./models/dbcon.php");
    require_once ("./models/brand/brand.php");
    class ShowAdminPrdDetail {
        public function showPrdDetail($id){
            require_once("./views/admin/prd_detail.php");
            $db = new ConnectDB();
            $brand = new Brand();
            $data = $db->getOneProduct($id);
            $main = new Prd_Detail();
            $main->PrdDetailPage($data, $db->GetAllSex(), $brand->GetAllBrand());
        }
    }
?>