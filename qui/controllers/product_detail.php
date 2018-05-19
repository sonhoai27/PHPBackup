<?php
    require_once("./models/product/product.php");
    class ProductDetail{
        public function ShowProductDetail($id){
            require_once('./views/detail_products.php');
            $main = new Product_Detail();
            $prd = new M_Product();
            $prd_detail = $prd->GetOneProduct($id);

            $list_sale_prd = $prd->GetAllPrdCustom(4,0);

            $prd_list = array();
            $prd_list['list_sale_prd'] = $list_sale_prd;

            $main->Product_Detail_Page($prd_detail, $prd_list);
        }
    }
?>