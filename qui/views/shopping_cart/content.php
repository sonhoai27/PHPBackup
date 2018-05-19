<?php
	class View_Cart {
		public function Content_Cart() {
			require_once("./theme/cart/main_cart.php");
		}
		public function CheckOut_View(){
			require_once("./theme/cart/checkout.php");
		}
	}
?>