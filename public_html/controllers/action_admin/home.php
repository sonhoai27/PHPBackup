<?php
    require_once("./models/product/product.php");
    require_once("./models/order/order.php");
    class ShowAdminPage{
        public function showAdmin(){
            require_once("./views/admin/home.php");
            $main = new Admin();
            $prd = new M_Product();
            $order = new M_Order();
            $main->AdminPage($prd->CountRow(), $order->GetSomeOrder(), $order->CountRow(), $order->CountRow_uncheck(), $order->CountRow_checked());
        }
    }
?>