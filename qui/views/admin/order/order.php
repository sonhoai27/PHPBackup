<?php
    class Order_V{
        public function Order_Home($list_order = array()){
            require_once("./theme/admin/order/order.php");
        }
        public function Order_detail($get_order, $prd_order){
            require_once("./theme/admin/order/order_detail.php");
        }
        public function Order_Add(){

        }
    }
?>
