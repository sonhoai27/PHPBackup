<div class="row">
    <div class="col-xs-12 sh_prd_header_btn_action">
        <div class="sh_title_manager_product" style="margin-bottom: 50px;">
            <h2>Quản lý danh sách cần liên hệ</h2>
        </div>
        <?php
            if(isset($_SESSION['detele_order_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã xóa thành công.
                    </div>
                </div>
            <?php }
             unset($_SESSION['detele_order_success']);
        ?>
    </div>
    <div class="col-xs-12 sh_prd_option_search">
        <div class="sh_prd_option_category">
            <select id="sh_filter_order_onoff">
                <option value="volvo">Lựa chọn</option>
                <option value="chua-xac-nhan">Chưa xác nhận</option>
                <option value="da-xac-nhan">Đã xác nhận</option>
            </select>
        </div>
        <!-- <div class="sh_prd_search">
            <input type="text" placeholder="Tìm kiếm đơn liên hệ"/>
        </div> -->
        <div class="sh_prd_option_category">
            <select id="sh_filter_order_date">
                <option value="volvo">Xem theo ngày</option>
                <option value="desc">Mới tới cũ</option>
                <option value="asc">Cũ tới mới</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <div class="sh_content_filter_tag">
            <?php
            $loc = isset($_GET['loc']) ? $_GET['loc'] : "";
            $xem = isset($_GET['xem']) ? $_GET['xem'] : "";
            if($loc != "" || $xem != ""){
              echo "Bạn đang xem: <span>".$loc."</span>"." - "."<span>".$xem."</span>";
              echo "<p onclick='Sh_Exit_Filtter_Contact()'>Thoát</p>";
            }
          ?>
        </div>
    </div>
    <div class="col-xs-12 space_top_small">
        <div class="sh_list_order">
            <div class="row" style="margin: 0">
                <div class="sh_title_list_order">
                    <p style="margin-bottom: 0; font-size: 18px;">Liên hệ</p>
                </div>
            </div>
            <div class="row" style="margin: 0">
                <div class="table-responsive sh_content_list_new_order">
                    <table class="sh_table_list_order" width="100%">
                        <tr class="sh_border_table" width="100%">
                            <td width="5%" class="text-center">#</td>
                            <td width="20%">Khách hàng</td>
                            <td width="15%">Số điện thoại</td>
                            <td width="40%">Email</td>
                            <td width="20%">Xác nhận</td>
                        </tr>
                        <?php
                        $dem = 1;
                        foreach ($list_arr['list_order_usa'] as $list_ct) {?>
                          <tr width="100%">
                              <td><?php echo $dem++?></td>
                              <td><a href="?a=order&pages=detail&dir=list_order_usa&id=<?php echo $list_ct['id_order_usa']?>"><?php echo $list_ct['name_order_usa']?></a></td>
                              <td><?=$list_ct['phone_order_usa']?></td>
                              <td><?=$list_ct['email_order_usa']?></td>
                              <td><?php
                                  if($list_ct['onoff_order_usa'] == 0){
                                      echo "<span>Chưa</span>";
                                  }else{
                                      echo "<span style='color: var(--primary-color)'>Rồi</span>";
                                  }
                              ?></td>
                          </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <?php
            $current = NULL;
            $current_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            if(isset($_GET['trang'])){
                $current = explode("trang", $current_link)[0]."trang=";
            }else{
                $current = $current_link."&trang=";
            }
            ?>
            <div class="sh_pagination p12">
              <ul>
                  <a href="<?php echo $current;
                      if(!isset($_GET['pg'])){
                          echo 1;
                      }else {
                          if($_GET['pg'] - 1 == 0){
                              echo 1;
                          }else{
                              echo $_GET['pg'] - 1;
                          }
                      }
                  ?>"><li>Trở về</li></a>
                  <a href="<?php echo $current;
                    if(!isset($_GET['trang']) && $list_arr['sum_order_usa'] - 8 <= 0){
                        echo 1;
                    }else{
                        if(!isset($_GET['trang']) && $list_arr['sum_order_usa'] - 8 > 0){
                            echo 2;
                        } 
                    }
                    if(isset($_GET['trang']) && $list_arr['sum_order_usa'] - $_GET['trang']*8 > 0){
                        echo $_GET['trang'] + 1;
                    }else{
                        if(isset($_GET['trang']) && $list_arr['sum_order_usa'] - $_GET['trang']*8 <= 0){
                            echo $_GET['trang'];
                        }
                    }
                ?>"><li>Trang tiếp theo</li></a>
              </ul>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
<script>
 $(document).ready(() => {
        $("#sh_filter_order_onoff").change(() => {
            var value_brand = $("#sh_filter_order_onoff").find("option:selected").val()
            var link_prd = "&loc="
                //history.pushState("stateObj", "Loc hang", link_prd + value_brand);
            var current_link = window.location.href.split("&")
            if (current_link.length == 2) {
                current_link = current_link[0] + "&" +current_link[1] +  link_prd + value_brand
                window.location = current_link
            } else {
                if ((current_link.length > 2 && current_link[2].split("=")[0] == "xem")) {
                    current_link = current_link[0] + "&" +current_link[1] + link_prd + value_brand + '&' + current_link[2]
                    window.location = current_link
                } else {
                    if(current_link.length > 3 && current_link[3].split("=")[0] == "xem"){
                        current_link = current_link[0] + "&" +current_link[1] + link_prd + value_brand + '&' + current_link[3]
                        window.location = current_link
                    }else{
                        if(current_link.length > 2 && current_link[2].split("=")[0] != "xem"){
                            current_link = current_link[0] + "&" +current_link[1] + link_prd + value_brand
                            window.location = current_link
                        }
                    }
                   
                }
            }
        })
        $("#sh_filter_order_date").change(() => {
            var value_filter = $("#sh_filter_order_date").find("option:selected").val()
            var link_filter = "&xem="
                //history.pushState("stateObj", "Loc hang", link_prd + value_brand);
            var current_link = window.location.href.split("&")
            if (current_link.length == 2) {
                current_link = current_link[0] +"&"+ current_link[1] + link_filter + value_filter
                window.location = current_link
            } else {
                if (current_link.length > 2 && current_link[2].split("=")[0] == "loc") {
                    current_link = current_link[0] +"&"+ current_link[1]+ '&' + current_link[2] + link_filter + value_filter
                    window.location = current_link
                } else {
                   if(current_link.length > 2 &&  current_link[2].split("=")[0] != "loc"){
                    current_link = current_link[0] +"&"+ current_link[1] + link_filter + value_filter
                    window.location = current_link
                   }
                }
            }
        })
    })
    function Sh_Exit_Filtter_Contact(){
        var current_link = window.location.href.split("&")[0] +"&"+ window.location.href.split("&")[1]
        window.location = current_link;
    }
</script>