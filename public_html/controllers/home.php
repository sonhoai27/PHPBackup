<?php
    require_once("./models/product/product.php");
    require_once("./models/brand/brand.php");
    class ShowHomePage {
       public function show_HomePage(){
           require_once('./views/content.php');
           $content = new Content();
           $prd = new M_Product();
           $brand = new Brand();
           $list_brands = $brand->GetRandomBrands();
           $list_sale_prd_unlimit = $prd->GetAllPrdCustom(8);
           $list_prd_new = $prd->GetAllPrdCustom(3, 0,"watch.id_watch", "DESC");
           $list_sale_prd = $prd->GetAllPrdCustom(3,0);
           $list_random_prd = $prd->GetAllPrdCustom(3,0, "RAND()");
           $list_viewed_prd = $prd->GetAllPrdCustom(3,0, "watch.views");
           $list_most_viewed_prd = $prd->GetAllPrdCustom(8,0, "watch.views");
           $arr = array();
           $arr['list_brands'] = $list_brands;
           $arr['list_sale_prd_unlimit'] = $list_sale_prd_unlimit;
           $arr['list_prd_new'] = $list_prd_new;
           $arr['list_sale_prd'] = $list_sale_prd;
           $arr['list_random_prd'] = $list_random_prd;
           $arr['list_viewed_prd'] = $list_viewed_prd;
           $arr['list_most_viewed_prd'] = $list_most_viewed_prd;
           $content->home($arr);
        }
}
?>
