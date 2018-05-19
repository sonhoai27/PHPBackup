<?php
    require_once ("./models/brand/brand.php");
    require_once ("./models/product/product.php");
    require_once ('./views/watches.php');
    class Watch{
        private $watch = NULL;
        private $brand = NULL;
        private $prd = NULL;
        function __construct() {
            $this->brand = new Brand();
            $this->watch = new Watches();
            $this->prd = new M_Product();
        }
        public function showWatchesBrand($choose = ""){
            $custom_get_prd = $this->prd->GetAllPrdCustom(8,0,"watch.id_watch","DESC","WHERE brand_id = id_brand and alias_brand = '$choose'");
            $this->watch ->WatchesPage($this->brand->GetAllBrand(),$custom_get_prd);
        }
        public function showWatchNotFilter(){
            $this->watch->WatchesPage($this->brand->GetAllBrand(), $this->prd->GetSomeProduct());
        }
        public function showWatchPrice($price){
            $price = $price."000000";
            $custom_get_prd = NULL;
            if($price == "4000000"){
                $custom_get_prd = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.id_watch",
                    "DESC",
                    "WHERE brand_id = id_brand",
                    "HAVING (price_watch - ((price_watch*sale_watch)/100)) < $price");
            }
            if($price == "5000000"){
                $custom_get_prd = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.id_watch",
                    "DESC",
                    "WHERE brand_id = id_brand",
                    "HAVING (price_watch - ((price_watch*sale_watch)/100)) >= $price
                    and (price_watch - ((price_watch*sale_watch)/100)) < 10000000");
            }
            if($price == "10000000"){
                $custom_get_prd = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.id_watch",
                    "DESC",
                    "WHERE brand_id = id_brand",
                    "HAVING (price_watch - ((price_watch*sale_watch)/100)) >= $price
                    and (price_watch - ((price_watch*sale_watch)/100)) < 20000000");
            }
            if($price == "20000000"){
                $custom_get_prd = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.id_watch",
                    "DESC",
                    "WHERE `brand_id` = `id_brand` and `price_watch` >= $price",
                    "HAVING (price_watch - ((price_watch*sale_watch)/100)) >= $price");
            }
            $this->watch->WatchesPage($this->brand->GetAllBrand(), $custom_get_prd);
        }
        public function showWatchesFilterSex($sex){
            $custom_get_prd = $this->prd->GetAllPrdCustom(
                8,
                0,
                "watch.id_watch",
                "DESC",
                "WHERE sex_watch = id_sex and alias_sex = '$sex'");
            $this->watch->WatchesPage($this->brand->GetAllBrand(), $custom_get_prd);
        }
        public function Pg_Prd_Custom_Smart_Filter($ct){
            if($ct == "xem-nhieu"){
                $query = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.views",
                    "DESC"
                );
                $this->watch->WatchesPage($this->brand->GetAllBrand(), $query);
            }
            if($ct == "gia-cao-thap"){
                $query = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.price_watch",
                    "DESC"
                );
                $this->watch->WatchesPage($this->brand->GetAllBrand(), $query);
            }
            if($ct == "gia-thap-cao"){
                $query = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.price_watch",
                    "ASC"
                );
                $this->watch->WatchesPage($this->brand->GetAllBrand(), $query);
            }
            if($ct == "giam-gia"){
                $query = $this->prd->GetAllPrdCustom(
                    8,
                    0,
                    "watch.sale_watch",
                    "DESC"
                );
                $this->watch->WatchesPage($this->brand->GetAllBrand(), $query);
            }
        }
    }
?>