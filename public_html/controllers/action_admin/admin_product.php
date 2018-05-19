<?php
    require_once("./models/dbcon.php");
    require_once("./models/product/product.php");
    require_once("./views/admin/product.php");
    require_once("./models/brand/brand.php");
    class ShowAdminProductPage{
        public function showAdminProduct($brd = "", $arrange = "", $pg = 0){
            $getProduct = new ConnectDB();
            $main = new Product();
            $brand = new Brand();
            $arr = array();
            $list_brand = $brand->GetAllBrand();

            if($brd == "" && $arrange == ""){
                $resultPrd = $getProduct->getAllProduct($pg);
            }
            if($brd !="" && $arrange == ""){
                $where = "brand_id = id_brand and alias_brand = '$brd'";
                $resultPrd = $getProduct->getAllProduct($pg, "watch.id_watch", "DESC", $where);
            }
            if($brd =="" && $arrange != ""){
                switch($arrange){
                    case 'desc': case 'asc': {
                       $resultPrd = $getProduct->getAllProduct($pg, "watch.id_watch", $arrange);
                    };break;
                    case 'nam': case 'nu': case 'unisex': {
                        $resultPrd = $getProduct->getAllProduct($pg, "watch.id_watch","DESC","sex_watch = id_sex and alias_sex = '$arrange' ");
                    };break;
                    case 'giam-gia': {
                        $resultPrd = $getProduct->getAllProduct($pg, "watch.id_watch","DESC", "sex_watch = id_sex", "watch.sale_watch");
                    };break;
                }

            }
            if($brd !="" && $arrange != ""){
                switch($arrange){
                    case 'desc': case 'asc': {
                       $resultPrd = $getProduct->getAllProduct(
                           $pg,
                           "watch.id_watch",
                           $arrange,
                           "brand_id = id_brand and alias_brand = '$brd'"
                        );
                    };break;
                    case 'nam': case 'nu': case 'unisex': {
                        $resultPrd = $getProduct->getAllProduct(
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "sex_watch = id_sex and alias_sex = '$arrange' and brand_id = id_brand and alias_brand = '$brd'"
                        );
                    };break;
                    case 'giam-gia': {
                        $resultPrd = $getProduct->getAllProduct(
                            $pg,
                            "watch.id_watch",
                            "DESC",
                            "sex_watch = id_sex and brand_id = id_brand and alias_brand = '$brd'",
                            "watch.sale_watch"
                        );
                    };break;
                }
            }
            $arr['list_prds'] = $resultPrd;
            $arr['list_brands'] = $list_brand;

            $main->ProductPage($arr);
        }

        public function Search_Prd_Admin_Controller($pg, $key_search = "", $code_search = ""){
            $prd = new M_Product();
            $brand = new Brand();
            $main = new Product();
            $list_brand = $brand->GetAllBrand();
            $arr = array();
            switch($code_search){
                case "name-prd": {
                    $list_prd = $prd->Search_Admin_Prd($pg, "name_watch like '%$key_search%");
                    $arr['list_prds'] = $list_prd;
                    $arr['list_brands'] = $list_brand;
        
                    $main->ProductPage($arr);
                };break;
                case "code-prd": {
                    $list_prd = $prd->Search_Admin_Prd($pg, "ksu_watch like '%$key_search%");
                    $arr['list_prds'] = $list_prd;
                    $arr['list_brands'] = $list_brand;
                    $main->ProductPage($arr);
                };break;
            }
        }
    }
?>
