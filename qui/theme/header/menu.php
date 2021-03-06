<?php
require_once("./models/brand/brand.php");
$brands = new Brand();
$list_brands = $brands->GetAllBrand();
?>
<script>
$(document).ready(function() {
    var Button_OnOff = false
    var screen_window = $(window).width()
    if (screen_window <= 768) {
       $("#id_content_top_main_menu").addClass("top_menu_hide")
        $(".menu_collapse").click(function() {
            console.log("status" + Button_OnOff)
            if (screen_window <= 768) {
                if (Button_OnOff === false) {
                    $("#id_content_top_main_menu").removeClass("top_menu_hide")
                    Button_OnOff = true
                } else {
                    if (Button_OnOff === true) {
                        $("#id_content_top_main_menu").addClass("top_menu_hide")
                        Button_OnOff = false
                    }
                }
            }
        })
     
    } else {
        if (screen_window > 768) {
            $("#id_content_top_main_menu").removeClass("menu_static_top")
            Button_OnOff = true
        }
    }
})
</script>
<div class="mobile_content_main_menu">

</div>
<div class="container-fluid content_main_menu">
    <div class="row">
        <div class="col-xs-12 alert-au-menu">
            <p class="text-center" style="margin-top: 15px!important; display: block;color: red">
              Cam kết 100% chính hãng, nếu phát hiện hàng giả, nhái hoàn tiền 100% giá trị sản phẩm.
            </p>
        </div>
    </div>
    <?php
        if(isset($_SESSION["alert_notify_order"]) == "OK"){?>
            <div class="col-xs-12" style="margin-top: 25px;">
                <div class="alert alert-success">
                    <strong>Thành Công!</strong> Bạn đã đặt hàng thành công!.
                </div>
            </div>
    <?php }
      unset($_SESSION["alert_notify_order"]);
     ?>
    <div class="row">
        <div class="container">
            <div class="row content_contact_us">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 live-chat-icon">
                    <span><a href="tel:0986897939">0986897939</a> </span>
                    <span><a href="https://www.facebook.com/DQWatch/?pnref=lhc">Facebook</a></span>
                    <span>dinh.qui94@gmail.com</span>
                </div>
                <div class="col-sm-3"></div>
            </div> 
            <div class="row content_top_search">
                <div class=" col-xs-12 col-sm-4">
                    <div class="name-shop"><p><a href="<?=$BASE_URL?>">ĐQWatch</a></p></div>
                </div>
                <div class="col-xs-12 col-sm-4 search-form">
                    <select id="box_filter_search_prd">
                        <option value="name-prd" selected>Theo tên</option>
                        <option value="code-prd">Theo mã</option>
                    </select>
                    <form action="" method="get" id="search_bar">
                        <!-- <input type="text" id="box_input_search_prd" style="dusplay: none"> -->
                        <input class="search-model" type="text" placeholder="Tìm theo tên hoặc mã" id="check_input-search_bar"/>
                        <span></span>
                    </form>
                </div>
                <div class="col-xs-3 col-sm-4 icon-cart-bag">
                      <p class="title-shopping-bag">
                        <a href="<?=$BASE_URL?>cart">
                            <span class="sum_item_car">
                                <?php
                                if(isset($_SESSION['cart'])){
                                    echo count($_SESSION['cart']);
                                }else{
                                    echo 0;
                                }
                                ?>
                            </span>
                        </a>
                      </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row content_top_main_menu" id="id_content_top_main_menu">
        <div class="top_main_menu">
            <ul>
                <li><a href="<?=$BASE_URL?>dong-ho"><p>Đồng hồ</p></a>
                    <ul>
                        <?php foreach ($list_brands as $brands){?>
                            <li><a href="<?=$BASE_URL?>dong-ho/hang/<?php echo $brands['alias_brand']?>"><?php echo $brands['name_brand']?></a></li>
                        <?php }?>
                    </ul>
                </li>
                <li><a href="<?=$BASE_URL?>dong-ho-nam"><p>Nam</p></a></li>
                <li><a href="<?=$BASE_URL?>dong-ho-nu"><p>Nữ</p></a></li>
                <li><a href="<?=$BASE_URL?>dong-ho-cap"><p>Couple watches</p></a></li>
                <li><a href="<?=$BASE_URL?>mua-hang-my"><p>Mua hàng Mỹ</p></a></li>
            </ul>
        </div>
    </div>
    <div class="menu_collapse">
        <span></span>
    </div>
</div>
