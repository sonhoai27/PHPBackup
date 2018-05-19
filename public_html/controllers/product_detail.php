<?php
    require_once("./models/product/product.php");
    class ProductDetail{
        public function ShowProductDetail($id){
            require_once('./views/detail_products.php');
            $main = new Product_Detail();
            $prd = new M_Product();
            $prd_detail = $prd->GetOneProduct($id);

            $list_prd_new = $prd->GetAllPrdCustom(3, 0,"watch.id_watch", "DESC");
            $list_sale_prd = $prd->GetAllPrdCustom(3,0);
            $list_random_prd = $prd->GetAllPrdCustom(3,0, "RAND()");
            $list_viewed_prd = $prd->GetAllPrdCustom(3,0, "watch.views");

            $prd_list = array();

            $prd_list['list_prd_new'] = $list_prd_new;
            $prd_list['list_sale_prd'] = $list_sale_prd;
            $prd_list['list_random_prd'] = $list_random_prd;
            $prd_list['list_viewed_prd'] = $list_viewed_prd;

            $main->Product_Detail_Page($prd_detail, $prd_list);
        }
    }
?>