<?php
    require_once("./models/product/product.php");
    require_once("./models/brand/brand.php");
    class ShowHomePage {
       public function show_HomePage(){
           require_once('./views/content.php');
           $content = new Content();
           $prd = new M_Product();
           $brand = new Brand();
           $list_sale_prd_unlimit = $prd->GetAllPrdCustom(8);
           $list_prd_new = $prd->GetAllPrdCustom(8, 0,"watch.id_watch", "DESC");
           $arr = array();
           $arr['list_sale_prd_unlimit'] = $list_sale_prd_unlimit;
           $arr['list_prd_new'] = $list_prd_new;
           $content->home($arr);
        }
}
?>
