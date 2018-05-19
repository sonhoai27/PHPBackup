<?php
ob_start();
session_start();
$main_title = "DQWatch - Hàng Hiệu Xách Tay Chính Hãng Authentic";
$BASE_URL = "https://dqwatch.com/";
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
<script>

$(document).ready(function() {
		var code_search_product = ""
		code_search_product = $("#box_filter_search_prd").val()
    var value_search = "";
    $("#box_filter_search_prd").click(function() {
        value_search = $("#check_input-search_bar").val()
        code_search_product = $("#box_filter_search_prd").val()
        $("#search_bar").attr('action', './tim-kiem/' + code_search_product + '/' + value_search)
    })
    $("#search_bar").keyup(function(e) {
        e.preventDefault()
        value_search = $("#check_input-search_bar").val()
				code_search_product = $("#box_filter_search_prd").val()
        $("#search_bar").attr('action', './tim-kiem/' + code_search_product + '/' + value_search)
    })
})
</script>
<body>
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10&appId=1002290079913192";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- <div id="fb-root"></div>
  <script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <style>#cfacebook{position:fixed;bottom:0px;right:10px;z-index:999999999999999;width:200px;height:auto;box-shadow:6px 6px 6px 10px rgba(0,0,0,0.2);border-top-left-radius:5px;border-top-right-radius:5px;overflow:hidden;}#cfacebook .fchat{float:left;width:100%;height:270px;overflow:hidden;display:none;background-color:#fff;}#cfacebook .fchat .fb-page{margin-top:-130px;float:left;}#cfacebook a.chat_fb{float:left;padding:0 25px;width:250px;color:#fff;text-decoration:none;height:40px;line-height:40px;text-shadow:0 1px 0 rgba(0,0,0,0.1);background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAqCAMAAABFoMFOAAAAWlBMV…8/UxBxQDQuFwlpqgBZBq6+P+unVY1GnDgwqbD2zGz5e1lBdwvGGPE6OgAAAABJRU5ErkJggg==);background-repeat:repeat-x;background-size:auto;background-position:0 0;background-color:#3a5795;border:0;border-bottom:1px solid #133783;z-index:9999999;margin-right:12px;font-size:18px;}#cfacebook a.chat_fb:hover{color:yellow;text-decoration:none;}</style>
  <script>
  jQuery(document).ready(function () {
  jQuery(".chat_fb").click(function() {
jQuery('.fchat').toggle('slow');
  });
  });
  </script>
  <div id="cfacebook">
  <a href="javascript:;" class="chat_fb" onclick="return:false;"><i class="fa fa-facebook-square"></i> Tin nhắn qua Facebook</a>
  <div class="fchat">
  <div class="fb-page" data-tabs="messages" data-href="https://www.facebook.com/DQWatch" data-width="150" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
  </div>
  </div> -->
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59db738ec28eca75e4624f70/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
	<div class="menu-header">
		<?php
		require_once('./theme/header/menu.php');
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
                        case "nam" : case "nu" : case "dong-ho-cap" : {
                                $_SESSION['gioi-tinh'] = $sex;
                                if($hang == "" && $gia == "" && $loc == ""){
																		$sex= addslashes($sex);
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
						$dir = isset($_GET['dir']) ? $_GET['dir'] : "";
						$main = new Transport_Controller();
						if($dir == ""){
							$main->Main_Transport();
						}else{
							if($dir == "add_trans"){
								$main->Add_Trans();
							}
						}
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
	<div class="silder_contact">
		<p id="Sildbar_phone"></p>
		<p id="Sildbar_email"></p>
	</div>
</body>
</html>
<?php
ob_end_flush();
?>
