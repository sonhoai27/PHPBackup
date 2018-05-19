<?php
	require_once("./models/product/product.php");
	require_once("./views/shopping_cart/content.php");
	class Shopping_Cart {
		private $main = NULL;
		function __construct(){
			$this->main = new View_Cart();
		}
		public function Main_Cart(){
			$this->main->Content_Cart();
		}
		public function AddToCart($id) {
			$prd = new M_Product();
			$arr_prd = $prd->GetOneProduct($id);
			$s_prd = $arr_prd[0];
			$price_off_qty = NULL;
			if(!isset($_SESSION['cart']) || $_SESSION['cart'] == null) {
					$_SESSION['cart'][$id] = $s_prd;
					$_SESSION['cart'][$id]['qty_watch'] = 1;
					$price_off_qty = (($s_prd['price_watch']) - (($s_prd['price_watch']*$s_prd['sale_watch'])/100))*$_SESSION['cart'][$id]['qty_watch'];
					$_SESSION['cart'][$id]['price_off'] = $price_off_qty;
					echo "THANH_CONG";
				}
			else {
				if(isset($_SESSION['cart'][$id])){
					$_SESSION['cart'][$id]['qty_watch'] += 1;
					$price_off_qty = (($s_prd['price_watch']) - (($s_prd['price_watch']*$s_prd['sale_watch'])/100))*$_SESSION['cart'][$id]['qty_watch'];
					$_SESSION['cart'][$id]['price_off'] = $price_off_qty;
					echo "THANH_CONG";
				}else {
					$_SESSION['cart'][$id] = $s_prd;
					$_SESSION['cart'][$id]['qty_watch'] = 1;
					$price_off_qty = (($s_prd['price_watch']) - (($s_prd['price_watch']*$s_prd['sale_watch'])/100))*$_SESSION['cart'][$id]['qty_watch'];
					$_SESSION['cart'][$id]['price_off'] = $price_off_qty;
					echo "THANH_CONG";
				}
			}
		}
		public function CheckOut(){
			$this->main->CheckOut_View();
		}
		public function AddCartToDataBase(){
			$prd = new M_Product();
			$payemnt = $address = $email = $name = $phone = NULL;
			if(isset($_POST['add_order'])){
				$address = $_POST['checkout_address'];
				$email = $_POST['checkout_email_buyer'];
				$name = $_POST['checkout_name_buyer'];
				$phone = $_POST['checkout_number_phone_buyer'];
				$payemnt = $_POST['payment_methods'];
				$total = $_POST['total_order'];
				if($total != NULL && $payemnt != NULL && $address != NULL && $email != NULL && $name != NULL && $phone != NULL){
					$last_id = $prd->AddToOrder($payemnt, $address, $email, $name, $phone, $total);
					if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
						$dem = count($_SESSION['cart']);
						foreach($_SESSION['cart'] as $sp){
							$prd->AddProductOrder(
								$dem,
								$last_id,
								addslashes($sp['name_watch']),
								$sp['price_off'],
								$sp['qty_watch'],
								$sp['content_img'],
								$sp['id_watch']);
						}
						$url_dir = "./";
						if (headers_sent()) {
							$_SESSION['alert_notify_order'] = "OK";
							die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
						}
						else{
							$_SESSION['alert_notify_order'] = "NO";
							exit(header("Location: $url_dir"));
						}
					}
				}else {
					$_SESSION['alert_notify_order'] = "NO";
					$url_dir = "./checkout";
					if (headers_sent()) {
						die("Redirect failed. Please click on this link: <a href=$url_dir>$url_dir</a>");
					}
					else{
						exit(header("Location: $url_dir"));
					}
				}
			}
		}
	}
?>
