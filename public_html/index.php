<?php
ob_start();
session_start();
$BASE_URL = "http://localhost:8081/public_html/";
$main_title = "Q.SHOP - HÀNG HIỆU AUTHENTIC";
// $BASE_URL = "https://dqwatch.com/";
function UpdateNumberPrdCart($arr = array(), $id_prd = 0){
    foreach($arr as $list_item_cart){
        if($list_item_cart['id_watch'] == $id_prd){
            return count($arr);
            break;
        }
    }
    return count($arr) + 1;
}
?>
<?php
require_once ("./header.php");
?>
<body>
	<div class="menu-header">
		<?php
		require_once('./theme/header/menu.php');
		//require_once('./theme/header/notify.php');
		?>
	</div>
	<?php
		$controller_path = "controllers";
		$action = isset($_GET['action']) ? $_GET['action']:"";
		require_once ('./controllers/home.php');
		require_once('./controllers/watches.php');
		require_once('./controllers/sex_pages.php');
		require_once ('./controllers/product_detail.php');
		require_once ('./controllers/shopping_cart.php');
        require_once ('./controllers/search.php');
        require_once ("./controllers/help.php");
        require_once ("./controllers/transport.php");
		if($action != ""){
				if(!file_exists("./$controller_path/$action.php")){
                    header("location: ./404.php");
				}
				if($action == "watches"){
				    $filter = isset($_GET['filter']) ? $_GET['filter'] : "";
                    $name_brand = isset($_GET['name']) ? $_GET['name'] : "";
                    $price = isset($_GET['from']) ? $_GET['from'] : "";
                    $sex = isset($_GET['sex']) ? $_GET['sex'] : "";
                    $ct = isset($_GET['ct']) ? $_GET['ct'] : "";
					$main = new Watch();
					if($filter == ""){
                        $main->showWatchNotFilter();
                    }else{
                        if($filter != ""){
                            switch ($filter){
                                case "hang" : {
                                    if($name_brand != ""){
                                        $main->showWatchesBrand($name_brand);
                                    }
                                };break;
                                case "gioi-tinh" : {
                                    if ($sex != ""){
                                        $main->showWatchesFilterSex($sex);
                                    }
                                };break;
                                case "custom-view" : {
                                    if($ct != ""){
                                        $main->Pg_Prd_Custom_Smart_Filter($ct);
                                    }
                                };break;
                                case "gia" : {
                                    if($price != "" && is_numeric($_GET['from'])){
                                        $main->showWatchPrice($price);
                                    }
                                };break;
                                default : {
                                    header("location: ./404.html");
                                }; break;
                            }
                        }
                    }
				}
				if($action == "sex_pages"){
				    $sex = isset($_GET['sex']) ? $_GET['sex'] : "";
				    $hang = isset($_GET['hang']) ? $_GET['hang'] : "";
                    $gia = isset($_GET['gia']) ? $_GET['gia'] : "";
                    $loc = isset($_GET['loc']) ? $_GET['loc'] : "";
					$main = new Sex_Pages_C();
                    switch ($sex){
                        case "nam" : case "nu" : case "unisex" : {
                                $_SESSION['gioi-tinh'] = $sex;
                                if($hang == "" && $gia == "" && $loc == ""){
                                    $choose = "WHERE `sex_watch` = `id_sex` and `alias_sex` = '$sex' and brand_id = id_brand";
                                    $main->Show_Sex_Page_C($sex, $choose);
                                }else{
                                    if($hang != "" && $gia == "" && $loc == ""){
                                        $choose = "WHERE
                                            `sex_watch` = `id_sex`
                                            and `alias_sex` = '$sex'
                                            and brand_id = id_brand
                                            and alias_brand = '$hang'";
                                        $main->Show_Sex_Page_C($sex, $choose);
                                    }else{
                                        if($hang == "" && $gia != "" && $loc == ""){
                                            $gia = $gia."000000";
                                            switch ($gia){
                                                case "4000000" : {
                                                    $choose = "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` <= $gia";
                                                    $main->Show_Sex_Page_C($sex, $choose);
                                                }; break;
                                                case "5000000" : {
                                                    $choose = "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $gia and `price_watch` < 10000000";
                                                    $main->Show_Sex_Page_C($sex, $choose);
                                                };break;
                                                case "10000000" : {
                                                    $choose = "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $gia and `price_watch` < 20000000";
                                                    $main->Show_Sex_Page_C($sex, $choose);
                                                };break;
                                                case "20000000" : {
                                                    $choose = "WHERE `sex_watch` = `id_sex` and `brand_id` = `id_brand` and `alias_sex` = '$sex' and `price_watch` >= $gia";
                                                    $main->Show_Sex_Page_C($sex, $choose);
                                                };break;
                                            }
                                        }else{
                                            if($loc != "" && $hang == "" && $gia == ""){
                                                switch ($loc){
                                                    case "xem-nhieu" : {
                                                        $main->GetFilterPrdOfSex($loc, $sex);
                                                    };break;
                                                    case "gia-cao-thap" : {
                                                        $main->GetFilterPrdOfSex($loc, $sex);
                                                    };break;
                                                    case "gia-thap-cao" : {
                                                        $main->GetFilterPrdOfSex($loc, $sex);
                                                    };break;
                                                    case "giam-gia" : {
                                                        $main->GetFilterPrdOfSex($loc, $sex);
                                                    };break;
                                                }
                                            }
                                        }
                                    }
                                }
                            } break;
                        default : header("location: ./404.html"); break;
                    }
				}
				if($action == "product_detail"){
					$id = isset($_GET['id']) ? $_GET['id'] : "";
					$main = new ProductDetail();
					if($id != ""){
						//echo $id;
						$main->ShowProductDetail($id);
					}
				}
				if($action == "shopping_cart"){
					$id = isset($_GET['id']) ? $_GET['id'] : "";
					$main = new Shopping_Cart();
					if($id == ""){
						$main->Main_Cart();
					}else {
						if($id == "checkout"){
							$main->CheckOut();
						}
						if($id == "buy_it"){
							$main->AddCartToDataBase();
						}
					}
				}
				if($action == "search"){
                    $main = new Search_C();
                    $main->Page_Search();
                }
                if($action == "help"){
				    $main = new Help_Controller();
				    $main->Main_Help_Controller();
                }
                if($action == "transport"){
                    $main = new Transport_Controller();
                    $main->Main_Transport();
                }

		}else{
                echo "<title>".$main_title."</title>";
				$main = new ShowHomePage();
				$main->show_HomePage();
		}
	?>
	<div class="footer-page">
		<?php
		require_once ('./theme/footer/footer_page.php');
		?>
	</div>
	<div class="footer-info">
		<?php
		require_once ('./theme/footer/footer_info.php');
		?>
	</div>
    <div class="toast jam" aria-hidden="true">
        Thêm thành công!.
    </div>
    <script>
        function Add_To_Car_Main(id) {
            var ma_id_prd = id
            <?php $id_prd = "<script>document.write(ma_id_prd)</script>"?>
            <?php
            $cart = array();
            if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                }
            ?>
            var numberCart = <?php echo UpdateNumberPrdCart($cart, $id_prd)?>;
            $.post("./res_st.php?a=add_to_cart", {id_sp: ma_id_prd}, data => {
                if(data == "THANH_CONG"){
                    $('.toast').addClass('on');
                    setTimeout(function() {
                        $(".sum_item_car").html(numberCart)
                        $('.toast').removeClass('on');
                    }, 2500);
                }
            })
        }
    </script>
</body>
</html>
<?php
ob_end_flush();
?>
