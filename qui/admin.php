<?php
ob_start();
session_start();
$BASE_URL = "https://dqwatch.com/";
$BASE_URL_ADMIN = "https://dqwatch.com/admin";
$main_title = "Q.SHOP - HÀNG HIỆU AUTHENTIC";
?>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <meta name="google-site-verification" content="XZdyn6Ez8VfQhnoEuZdeU8OIe49W8zZsk1lpsb5Gj0g" />
    <base href="<?=$BASE_URL_ADMIN?>">
    <!--    <base href="../">-->
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="<?=$BASE_URL?>public/styles/css/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="<?=$BASE_URL?>public/styles/css/main.css"/>
    <link rel="stylesheet" href="<?=$BASE_URL?>public/styles/css/style_js.css">
    <link rel="stylesheet" href="<?=$BASE_URL?>public/styles/css/editor.css">
    <link rel="stylesheet" media="all" href="<?=$BASE_URL?>public/styles/css/owl.carousel.css"/>
    <link rel="stylesheet" media="all" href="<?=$BASE_URL?>public/styles/css/owl.theme.default.css"/>
    <script src="<?=$BASE_URL?>public/styles/js/jquery.min.js"></script>
    <script src="<?=$BASE_URL?>public/styles/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$BASE_URL?>public/styles/js/script.js"></script>
    <script type="text/javascript" src="<?=$BASE_URL?>public/styles/js/editor.js"></script>
    <script type="text/javascript" src="<?=$BASE_URL?>public/styles/js/owl.carousel.js"></script>
    <link href="<?=$BASE_URL?>public/styles/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&amp;subset=vietnamese" rel="stylesheet">
</head>
<script type="text/javascript">
    // var windowsize = $(window).width();

    //     $(window).resize(function() {
    //       var windowsize = $(window).width();
    //     });

    //     if (windowsize < 1000) {
    //       //if the window is greater than 440px wide then turn on jScrollPane..
    //         alert('Not Working')
    //         window.location.href = "http://google.com"
    //     }
    $(document).ready(() => {
        var check_toggle_menu_mobile = true
        var check_toggle_menu_desktop = true
        var screen_window =  $( window ).width();
        if(screen_window <= 768){
            if(check_toggle_menu_mobile){
                $("#sh_navigation").addClass("sh_hidden")
                $("#sh_content_right").css({"margin-left": "0%"})
                $("#sh_content_right").removeClass("col-xs-10")
                $("#sh_content_right").addClass("col-xs-12")
                check_toggle_menu_mobile = false;
            }
        }
        $(".sh_toggle_menu_left").click(() => {
            if(screen_window > 786){
                if(check_toggle_menu_desktop){
                    $("#sh_navigation").addClass("sh_hidden")
                    $("#sh_content_right").css({"margin-left": "0%"})
                    $("#sh_content_right").removeClass("col-xs-10")
                    $("#sh_content_right").addClass("col-xs-12")
                    check_toggle_menu_desktop = false;

                }else{
                    $("#sh_navigation").removeClass("sh_hidden")
                    $("#sh_content_right").css({"margin-left": "16.4444%"})
                    $("#sh_content_right").removeClass("col-xs-12")
                    $("#sh_content_right").addClass("col-xs-10")
                    check_toggle_menu_desktop =true;
                }
            }else {
                if(screen_window <= 768){
                    if(check_toggle_menu_mobile){
                        $("#sh_navigation").addClass("sh_hidden")
                        $("#sh_content_right").css({"margin-left": "0%"})
                        $("#sh_content_right").removeClass("col-xs-10")
                        $("#sh_content_right").addClass("col-xs-12")
                        check_toggle_menu_mobile = false;
                    }
                    else{
                        $("#sh_navigation").removeClass("sh_hidden")
                        $("#sh_content_right").css({"margin-left": "16.4444%"})
                        $("#sh_content_right").removeClass("col-xs-12")
                        $("#sh_content_right").addClass("col-xs-10")
                        check_toggle_menu_mobile =true;
                    }
                }
            }
        })


    })
    $(document).ready(()=> {
        var dem = 0;
        $('#sh_add_new_btn_upload_img').click(() => {
            if(dem < 2){
                $('.sh_input_file_upload').append(`<input type="file" name="img-sp[]" id="img-sp" class="input_file">`)
                dem++
            }
        })
        $("#uploadimage_0").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_upload_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_0').attr("src", data)
                    console.log(data)
                }
            });
        }))
        $("#uploadimage_1").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_upload_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_1').attr("src", data)
                    console.log(data)
                }
            });
        }))
        $("#uploadimage_2").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_upload_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_2').attr("src", data)
                    console.log(data)
                }
            });
        }))
        $("#uploadimage_3").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_upload_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_3').attr("src", data)
                    console.log(data)
                }
            });
        }))
        $("#uploadimage_4").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_upload_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_4').attr("src", data)
                    console.log(data)
                }
            });
        }))
      $("#delete_img_0").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_delete_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_0').attr("src", data)
                    console.log(data)
                }
            });
        }))
      $("#delete_img_1").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_delete_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_1').attr("src", data)
                    console.log(data)
                }
            });
        }))
      $("#delete_img_2").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_delete_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_2').attr("src", data)
                    console.log(data)
                }
            });
        }))
      $("#delete_img_3").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_delete_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_3').attr("src", data)
                    console.log(data)
                }
            });
        }))
      $("#delete_img_4").on('submit',(function(e) {
            e.preventDefault()
            $.ajax({
                url: "./res_st.php?a=sh_delete_img",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success: function(data)
                {
                    $('#prd_d_img_4').attr("src", data)
                    console.log(data)
                }
            });
        }))
    })
</script>
    <body style="background: #fff">
        <?php
          require_once("./controllers/action_admin/login.php");
          if(isset($_SESSION['login']) && $_SESSION['login'] == "OK"){
            $dem = 0;
            $controller_path = "controllers/action_admin";
            $controller_path_1 = "controllers/action_admin/product";
            $action = isset($_GET['a']) ? $_GET['a']:"";
            require_once("./controllers/action_admin/product/product_c.php");
            require_once("./theme/admin/menu_left.php");
            require_once("./theme/admin/menu-admin-top.php");
            require_once('./controllers/action_admin/home.php');
            require_once('./controllers/action_admin/admin_product.php');
            require_once("./controllers/action_admin/prd_detail.php");
            require_once("./controllers/action_admin/order.php");
            require_once ("./controllers/action_admin/settings.php");
            if($action != ""){
                if(!file_exists("./$controller_path/$action.php")){
                    $dem = 1;
                }
                if((!file_exists("./$controller_path_1/$action.php") && $dem == 1)){
                    $dem = 1;
                }else{
                    $dem = 0;
                }
                if($dem == 0){
                    if($action == "admin_product"){
                      $main = new ShowAdminProductPage();
                      $brand = isset($_GET['hang']) ? $_GET['hang'] : "";
                      $arrange = isset($_GET['xem']) ? $_GET['xem'] : "";
                      $key_search = isset($_GET['sh_key_search_prd']) ? $_GET['sh_key_search_prd'] : "";
                      $code_search = isset($_GET['sh_code_search_prd']) ? $_GET['sh_code_search_prd'] : "";
                      if($brand == "" && $arrange == "" && $key_search == "" && $code_search == ""){
                        $page = isset($_GET['trang']) ? $_GET['trang'] : "";
                        if($page != ""){
                            $page = ($page - 1)*8;
                            $main->showAdminProduct("", "", $page);
                        }
                        $main->showAdminProduct();
                      }
                      if($brand == "" && $arrange == "" && $key_search != "" && $code_search != ""){
                        $page = isset($_GET['trang']) ? $_GET['trang'] : "1";
                        $page = ($page - 1)*8;
                        $main->Search_Prd_Admin_Controller($page, $key_search, $code_search);
                      }
                      if(($brand != "" && $arrange == "")){
                        $page = isset($_GET['trang']) ? $_GET['trang'] : "1";
                        $page = ($page - 1)*8;
                        $main->showAdminProduct($brand, "", $page);
                      }
                      if($brand == "" && $arrange != ""){
                        $page = isset($_GET['trang']) ? $_GET['trang'] : "1";
                        $page = ($page - 1)*8;
                        $main->showAdminProduct("", $arrange, $page);
                      }
                      if($brand != "" && $arrange != ""){
                        $page = isset($_GET['trang']) ? $_GET['trang'] : "1";
                        $page = ($page - 1)*8;
                        $main->showAdminProduct($brand, $arrange, $page);
                      }

                    }
                    if($action == "prd_detail"){
                        $id = isset($_GET['id']) ? $_GET['id'] : "";
                        $main = new ShowAdminPrdDetail();
                        if($id != ""){
                            $main->showPrdDetail($id);
                        }
                    }
                    if($action == "product_c"){
                        $main = new ShowAdminAddPrd();
                        $dir = isset($_GET['dir']) ? $_GET['dir']:"";
                         if($dir == ""){
                            $main->ShowAddPrd();
                         }else{
                             if($dir == "1"){
                                $info = $name = $brand = $price = $sale = $color = $sex = $size = $alias = $ksu = NULL;
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if(isset($_POST['ten-sp'])){
                                        $name = addslashes($_POST['ten-sp']); //cac ky tu dat biet se hien
                                    }
                                    if(isset($_POST['info-sp'])){
                                        $info = addslashes($_POST['info-sp']); //cac ky tu dat biet se hien
                                    }
                                    if(isset($_POST['hang-sp'])){
                                        $brand = $_POST['hang-sp'];
                                    }
                                    if(isset($_POST['alias-sp'])){
                                        $alias = $_POST['alias-sp'];
                                    }
                                    if(isset($_POST['gia-sp'])){
                                        $price = $_POST['gia-sp'];
                                    }
                                    if(isset($_POST['sale-sp'])){
                                        $sale = $_POST['sale-sp'];
                                    }
                                    if(isset($_POST['mau-sp'])){
                                        $color = $_POST['mau-sp'];
                                    }
                                    if(isset($_POST['size-sp'])){
                                        $size = $_POST['size-sp'];
                                    }
                                    if(isset($_POST['gioi-tinh'])){
                                        $sex = $_POST['gioi-tinh'];
                                    }
                                    if(isset($_POST['ksu-sp'])){
                                          $ksu = $_POST['ksu-sp'];
                                      }
                                }
                                $main->AddAdminPrd($name, $brand, $price, $sale, $color, $sex, $size, $alias, $info, $ksu);
                             }
                            if($dir == "2"){
                                $alias = $on_off_sp = $ksu = $info = $id = $name = $brand = $price = $sale = $color = $sex = $size = "";
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if(isset($_POST['id-sp'])){
                                        $id = $_POST['id-sp'];
                                    }
                                    if(isset($_POST['ten-sp'])){
                                        $name = addslashes($_POST['ten-sp']); //cac ky tu dat biet se hien
                                    }
                                    if(isset($_POST['info-sp'])){
                                        $info = addslashes($_POST['info-sp']); //cac ky tu dat biet se hien
                                    }
                                    if(isset($_POST['hang-sp'])){
                                        $brand = $_POST['hang-sp'];
                                    }
                                    if(isset($_POST['gia-sp'])){
                                        $price = $_POST['gia-sp'];
                                    }
                                    if(isset($_POST['sale-sp'])){
                                        $sale = $_POST['sale-sp'];
                                    }
                                    if(isset($_POST['mau-sp'])){
                                        $color = $_POST['mau-sp'];
                                    }
                                    if(isset($_POST['size-sp'])){
                                        $size = $_POST['size-sp'];
                                    }
                                    if(isset($_POST['gioi-tinh'])){
                                        $sex = $_POST['gioi-tinh'];
                                    }
                                    if(isset($_POST['ksu-sp'])){
                                      $ksu = $_POST['ksu-sp'];
                                    }
                                    if(isset($_POST['on-off-sp'])){
                                      $on_off_sp = $_POST['on-off-sp'];
                                    }
                                    if(isset($_POST['alias-sp'])){
                                      $alias = $_POST['alias-sp'];
                                    }
                                }
                                $main->UpdateAdminPrd($id, $name, $brand, $price, $sale, $color, $sex, $size, $info, $ksu, $on_off_sp, $alias);
                             }
                            if($dir == "3"){
                                if($_SERVER["REQUEST_METHOD"] == "POST"){
                                    if(isset($_POST['delete_id_watch'])){
                                        $id = $_POST['delete_id_watch'];
                                    }
                                    $main->DeleteAdminPrd($id);
                                }
                            }
                         }

                    }
                    if($action == "order"){
                        $pages = isset($_GET['pages']) ? $_GET['pages'] : "";
                        $pg = isset($_GET['trang']) ? $_GET['trang'] : "1";
                        $status = isset($_GET['loc']) ? $_GET['loc'] : "";
                        $filter = isset($_GET['xem']) ? $_GET['xem'] : "";
                        $order = new Order_C();
                        switch ($pages) {
                          case 'contacts':{
                             $order->Order_Home($pages, $status, $filter, $pg);
                            };break;
                          case 'list_order':{
                              $order->Order_Home($pages, $status, $filter ,$pg);
                            };break;
                         case 'list_order_usa':{
                            $order->Order_Home($pages, $status, $filter ,$pg);
                          };break;
                          case 'detail':{
                            $id = isset($_GET['id']) ? $_GET['id'] : "";
                            $dir = isset($_GET['dir']) ? $_GET['dir'] : "";
                            if($dir == "order"){
                              $order->Order_Detail($id);
                            }
                            if($dir == "contact"){
                              $order->Contact_Detail($id);
                            }
                            if($dir == "list_order_usa"){
                              $order->Order_Usa_Detail($id);
                            }
                          };break;
                          case 'confirm':{
                            $id = isset($_GET['id']) ? $_GET['id'] : "";
                            $dir = isset($_GET['dir']) ? $_GET['dir'] : "";
                            if($dir == "order"){
                              $order->Confirm_Order($id, $dir);
                            }
                            
                            if($dir == "contact"){
                              $order->Confirm_Order($id, $dir);
                            }
                            if($dir == "list_order_usa"){
                              $order->Confirm_Order($id, $dir);
                            }
                          };break;
                          case 'unconfirm':{
                            $id = isset($_GET['id']) ? $_GET['id'] : "";
                            $dir = isset($_GET['dir']) ? $_GET['dir'] : "";
                            if($dir == "order"){
                              $order->Un_Confirm_Order($id, $dir);
                            }
                            if($dir == "contact"){
                              $order->Un_Confirm_Order($id, $dir);
                            }
                            if($dir == "list_order_usa"){
                              $order->Un_Confirm_Order($id, $dir);
                            }
                          };break;
                          case 'delete':{
                            $id = isset($_GET['id']) ? $_GET['id'] : "";
                            $dir = isset($_GET['dir']) ? $_GET['dir'] : "";
                            if($dir == "order"){
                              $order->Delete_Order($id, $dir);
                            }
                            if($dir == "contact"){
                              $order->Delete_Order($id, $dir);
                            }
                            if($dir == "list_order_usa"){
                              $order->Delete_Order($id, $dir);
                            }
                          };break;
                        }
                    }
                    if($action == "settings"){
                        $main = new Settings_C();
                        $pages = isset($_GET['pages']) ? $_GET['pages'] : "";
                        if($pages == ""){
                            $main->Settings_Main();
                        }
                        if($pages == "delete_brand"){
                            $main->Delete_Brand();
                        }
                        if($pages == "policy"){
                            $main->Setting_Policy();
                        }
                    }
                    if($action == "login"){
                      $logout = new Login_Controller();
                      $ac = isset($_GET['ac']) ? $_GET['ac'] : "";
                      if($ac != ""){
                        $logout->Logout();
                      }
                    }
                }
                else{
                    if($dem != 0){
                        echo "<h1>ERROR 404</h1>";
                        echo $dem;
                    }
                }

            }else {
                if($action == ""){
                    $main = new ShowAdminPage();
                    $main->showAdmin();
                }
            }
          }else{
              $login = new Login_Controller();
              $login->Main_Login();
          }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center space_top_large">
                    <p>© 2017. Powered by <a href="https://fb.com/sonhoai.27" target="_blank">sonH</a> - Version: 0.5.</p>
                    <p>All rights reserved.</p>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
ob_end_flush();
?>
