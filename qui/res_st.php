<?php
    session_start();
    require_once("./controllers/res_st.php");
    require_once("./controllers/help.php");
    require_once ("./controllers/action_admin/order.php");
    $main = new RES_ST();
    $help = new Help_Controller();
    $order = new Order_C();
    if($_GET['a'] == "sh_upload_img"){
        $main->res_img();
    }
    if($_GET['a'] == "sh_delete_img"){
        $main->delete_img();
    }
    if($_GET['a'] == "add_to_cart"){
        if(isset($_POST['id_sp'])){
            $id = $_POST['id_sp'];
            $main->Add_To_Cart($id);
        }
    }
    if($_GET['a'] == "sh_add_new_brand"){
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $main->Add_New_Brand();
        }
    }
    if($_GET['a'] == "load_more_prds"){
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        $alias = isset($_GET['alias_prd']) ? $_GET['alias_prd'] : "";
        $price = isset($_GET['price_prd']) ? $_GET['price_prd'] : "";
        $sex = isset($_GET['sex_prd']) ? $_GET['sex_prd'] : "";
        $custom_smart_filter = isset($_GET['custom_smart_filter']) ? $_GET['custom_smart_filter'] : "";
        if($page != ""){
            $page = ($page - 1)*8;
            if($alias != "" && $sex == "" && $price == "" && $custom_smart_filter == ""){
                $list_prd = $main->Pg_Product($page, $alias);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($alias != "" && $sex != "" && $price == "" && $custom_smart_filter == ""){
                $list_prd = $main->Pg_Product($page, $alias, $sex);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($alias == "" && $price == "" && $sex == "" && $custom_smart_filter == ""){
                $list_prd = $main->Pg_Product($page);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($sex != "" && $alias == "" && $price == "" && $custom_smart_filter == ""){
                $list_prd = $main->Pg_Prd_Sex($page, $sex);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                           <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($price != "" && $alias == "" && $sex == "" && $custom_smart_filter == ""){
                $price = $price."000000";
                $list_prd = $main->Pg_Prd_Price($page, $price);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($price != "" && $alias == "" && $sex != "" && $custom_smart_filter == ""){
                $list_prd = $main->Pg_Prd_Price($page, $price, $sex);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($custom_smart_filter != "" && $price == "" && $alias == "" && $sex == ""){
                $column = NULL;
                $filter = NULL;
                switch ($custom_smart_filter){
                    case "gia-gia" : {
                        $column = "watch.sale_watch";
                        $filter = "DESC";
                    }; break;
                    case "xem-nhieu" : {
                        $column = "watch.views";
                        $filter = "DESC";
                    }; break;
                    case "gia-cao-thap" : {
                        $column = "watch.price_watch";
                        $filter = "DESC";
                    }; break;
                    case "gia-thap-cao" : {
                        $column = "watch.price_watch";
                        $filter = "ASC";
                    }; break;
                }
                $list_prd = $main->Pg_Prd_Custom_Smart_Filter($page, $column, $filter);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
            if($custom_smart_filter != "" && $sex != "" && $price == "" && $alias == ""){
                $column = NULL;
                $filter = NULL;
                switch ($custom_smart_filter){
                    case "giam-gia" : {
                        $column = "watch.sale_watch";
                        $filter = "DESC";
                    }; break;
                    case "xem-nhieu" : {
                        $column = "watch.views";
                        $filter = "DESC";
                    }; break;
                    case "gia-cao-thap" : {
                        $column = "watch.price_watch";
                        $filter = "DESC";
                    }; break;
                    case "gia-thap-cao" : {
                        $column = "watch.price_watch";
                        $filter = "ASC";
                    }; break;
                }
                $list_prd = $main->Pg_Prd_Custom_Smart_Filter($page, $column, $filter, $sex);
                foreach ($list_prd as $prd){
                    echo '
                <div class="col-sm-3">
                    <div class="product-item">
                        <a href="./dong-ho/'.$prd['alias_watch'].'-'.$prd['id_watch'].'">
                          <div class="wrapper-bg">
                              <div class="bg">
                                  <img src="'.$prd["content_img"].'" title="'.$prd['name_watch'].'" class="img img-responsive product-image-deals">
                              </div>
                          </div>
                          <div class="title-product" id="add_to_cart">
                              <span>'.$prd['name_watch'].'</span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              '.number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100))." VNĐ".'
                            </span>
                             <span class="add_to_cart">
                                <p onclick="Add_To_Car_Main('.$prd['id_watch'].')"></p>
                            </span>
                            <span class="product-sale">save '.$prd['sale_watch'].'%</span>
                            <p style="text-decoration: line-through; font-size: 12px; color: var(--second-color); display: block; margin-top: 8px!important;">
                               '.number_format($prd['price_watch'])." VNĐ".'
                            </p>
                        </div>
                    </div>
                </div> ';
                }
            }
        }
    }
    if($_GET['a'] == "sh_brands"){
        $page = isset($_GET['page']) ? $_GET['page'] : "";
        if($page != ""){
            $page = ($page - 1)*4;
            $list_brands = $main->Bg_Brand($page);
            foreach ($list_brands as $brands){
                echo "
                    <tr>
                        <td width='25%'>
                          <input
                           id='brand_".$brands['id_brand']."'
                           name ='brand_item_".$brands['id_brand']."'
                           type='checkbox' class='sh_btn_checkbox'
                           onclick = 'DeleteBrandId(".$brands['id_brand']."'>
                           <label for='brand_".$brands['id_brand']."'  class='sh_checkbox_label'></label></td>
                       <td width='50%'><p>".$brands['name_brand']."</p></td>
                       <td width='25%'><p>Sửa</p></td>
                    </tr>
                ";
            }
        }
    }
    if($_GET['a'] == "add_to_contact"){
        $email_phone = isset($_POST['your_email_phone_contact']) ? $_POST['your_email_phone_contact'] : "";
        $name_cus = isset($_POST['your_name_contact']) ? $_POST['your_name_contact'] : "";
        $info = isset($_POST['content_info_contact']) ? $_POST['content_info_contact'] : "";
        $id_prd= isset($_POST['id_prd']) ? $_POST['id_prd'] : "";
        $list = array();
        $list['email'] = $email_phone;
        $list['name'] = $name_cus;
        $list['info'] = $info;
        $list['id_prd'] = $id_prd;
        if($help->Add_To_Contact($list)){
            echo "OK";
        }else{
            echo "NOT";
        }
    }
    if($_GET['a'] == "load_more_order"){
        $pg = $_GET['page'];
        $pg = ($pg - 1)*8;
        $list_order = $order->Pg_List_Order($pg);
       foreach ($list_order['list_order'] as $order){
           $status = $order['status_order'] == 0 ? "Chưa kiểm tra" : "Đã kiểm tra";
           echo '
                <tr width="100%">
                <td>
                    <input id="i22'.$order['id_order'].'" type="checkbox" class="sh_btn_checkbox">
                    <label for="i22" class="sh_checkbox_label"></label>
                </td>
                <td><a href="?a=order&pages=detail&id='.$order['id_order'].'">'.$order['name_buyer'].'</a></td>
                <td>'.number_format($order['total_order']).' VND</td>
                <td>'.$status.'</td>
                </tr>
           ';
       }
    }
//$filter_where = "where brand_id = id_brand and sex_watch = id_sex and alias_sex = '$sex_brand' and brand_id = $id_brand";
?>
