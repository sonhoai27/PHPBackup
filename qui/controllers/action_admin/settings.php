<?php
    require_once ("./views/admin/settings.php");
    require_once("./models/brand/brand.php");
    class Settings_C {
        private $brand_c = NULL;
        private $settings = NULL;
        function __construct()
        {
            $this->brand_c = new Brand();
            $this->settings = new Settings_View();
        }

        public function Settings_Main(){

            $brand = $this->brand_c->Pagination_Get_Brand(0);
            $this->settings->Settings_Main($brand);
        }
        public function Delete_Brand(){
            if(isset($_POST['btn_detele_brand'])){
                $arr_id_brand = $_POST['arr_id_brand'];
                $this->brand_c->DeleteBrand($arr_id_brand);
            }
        }
        public function Setting_Policy(){
            $this->settings->Setting_Policy_View();
        }
    }
?>