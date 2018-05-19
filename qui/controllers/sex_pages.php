<?php
require_once('./views/sex_pages.php');
require_once ("./models/product/product.php");
require_once ("./models/brand/brand.php");
class Sex_Pages_C extends M_Product{
    public function Show_Sex_Page_C($sex, $choose = ""){
        $main = new SexPage();
        $brand = new Brand();
        $list = array();
        $list_brand = $brand->GetAllBrand();
        $list_prd = $this->GetAllPrdCustom(
            8,
            0,
            "watch.id_watch",
            "DESC",
            $choose);
        $list['list_prd'] = $list_prd;
        $list['list_brand'] = $list_brand;
        $main->Sex_Page_Main($sex, $list);
    }
    public function GetFilterPrdOfSex($filter, $sex){
        $main = new SexPage();
        $brand = new Brand();
        $list = array();
        $list_brand = $brand->GetAllBrand();
        switch ($filter){
            case "xem-nhieu" : {
                $list_prd = $this->GetAllPrdCustom(
                    8,
                    0,
                    "views",
                    "DESC",
                    "where watch.brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex' "
                );
            };break;
            case "giam-gia" : {
                $list_prd = $this->GetAllPrdCustom(
                    8,
                    0,
                    "sale_watch",
                    "DESC",
                    "where watch.brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex' "
                );
            };break;
            case "gia-cao-thap" : {
                $list_prd = $this->GetAllPrdCustom(
                    8,
                    0,
                    "price_watch",
                    "DESC",
                    "where watch.brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex' "
                );
            };break;
            case "gia-thap-cao" : {
                $list_prd = $this->GetAllPrdCustom(
                    8,
                    0,
                    "watch.price_watch",
                    "ASC",
                    "where brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex' "
                );
            };break;
        }
        $list['list_prd'] = $list_prd;
        $list['list_brand'] = $list_brand;
        $main->Sex_Page_Main($sex, $list);
    }
}
?>