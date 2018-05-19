<div class="row">
    <div class="col-xs-12 sh_prd_header_btn_action">
        <div class="sh_title_manager_product" style="margin-bottom: 50px;">
            <h2>Quản lý hóa đơn đặt hàng</h2>
        </div>
        <?php
            if(isset($_SESSION['detele_order_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã xóa thành công hóa đơn.
                    </div>
                </div>
            <?php }
             unset($_SESSION['detele_order_success']);
        ?>
    </div>
    <div class="col-xs-12 sh_prd_option_search">
        <div class="sh_prd_option_category">
            <select id="sh_filter_order_onoff">
                <option value="volvo">Tình trạng</option>
                <option value="chua-xac-nhan">Chưa xác nhận</option>
                <option value="da-xac-nhan">Đã xác nhận</option>
            </select>
        </div>
        <!-- <div class="sh_prd_search">
            <input type="text" placeholder="Tìm kiếm đơn đặt hàng"/>
        </div> -->
        <div class="sh_prd_option_category">
            <select id="sh_filter_order_date">
                <option value="volvo">Xem theo ngày</option>
                <option value="desc">Mới tới cũ</option>
                <option value="asc">Cũ tới mới</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 space_top_small">
        <div class="sh_list_order">
            <div class="table-responsive sh_content_list_new_order sh_tb_odd_even">
                <table class="sh_table_list_order" width="100%">
                    <tr class="sh_border_table" width="100%">
                        <td width="5%">#</td>
                        <td width="30%">Khách hàng</td>
                        <td width="20%">Thời gian</td>
                        <td width="30%">Giá tiền</td>
                        <td width="15%">Tình trạng</td>
                    </tr>
                    <?php
                        $dem = 1;
                    foreach($list_order['list_order'] as $order){?>
                        <tr width="100%">
                            <td><?php echo $dem++?></td>
                            <td><a href="?a=order&pages=detail&dir=order&id=<?php echo $order['id_order']?>"><?php echo $order['name_buyer']?></a></td>
                            <td><span><?php echo $order['date_order']?></span></td>
                            <td><?php echo number_format($order['total_order']).' VND'?></td>
                            <td><?php
                                if($order['status_order'] == 0){
                                    echo "<span>Chưa</span>";
                                }else{
                                    echo "<span style='color: var(--primary-color)'>Rồi</span>";
                                }
                            ?></td>
                        </tr>
                    <?php } ?>
                </table>
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
                      if(!isset($_GET['trang'])){
                          echo 1;
                      }else {
                          if($_GET['trang'] - 1 == 0){
                              echo 1;
                          }else{
                              echo $_GET['trang'] - 1;
                          }
                      }
                  ?>"><li>Trở về</li></a>
                  <a href="
                  <?php echo $current;
                    if(!isset($_GET['trang']) && $list_order['num_rows'] - 8 <= 0){
                        echo 1;
                    }else{
                        if(!isset($_GET['trang']) && $list_order['num_rows'] - 8 > 0){
                            echo 2;
                        } 
                    }
                    if(isset($_GET['trang']) && $list_order['num_rows'] - $_GET['trang']*8 > 0){
                        echo $_GET['trang'] + 1;
                    }else{
                        if(isset($_GET['trang']) && $list_order['num_rows'] - $_GET['trang']*8 <= 0){
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
</script>