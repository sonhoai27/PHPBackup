<script>
  var a = false;
  function KiemTraXoa(){
    if(!a){
      a = true
      document.getElementById("content_confirm_delete_prd").style.display = "block"
    }
    return a
  }
  function XacNhanXoa(){
    if(a){
      return true
      a = false;
    }
    return false
  }
  function Hiden_Confirm_Delete(){
    a = false
    document.getElementById("content_confirm_delete_prd").style.display = "none"
  }
</script>
<div class="row">
   <div class="col-xs-12">
        <div class="col-xs-12 sh_prd_header_btn_action">
            <div class="sh_title_manager_product">
                <h1>Chi tiết liên hệ</h1>
                <div class="sh_content_total_order">
                    <p>Khách hàng: <?php echo $order_usa_detail[0]['name_order_usa']?></p>
                    <span>SĐT: </span><span style="color: var(--primary-color);"><?php echo $order_usa_detail[0]['phone_order_usa']?></span>
                </div>
            </div>
            <div class="sh_prd_btn_action">
                <a href="?a=order&pages=list_order_usa" class="sh_action_link"><p>Thoát</p></a>
                <a class="sh_action_link" onclick="return KiemTraXoa()">
                  <p>Xóa</p>
                </a>
                <?php if($order_usa_detail[0]['onoff_order_usa'] == 0){?>
                    <a href="?a=order&pages=confirm&dir=list_order_usa&id=<?php echo $order_usa_detail[0]['id_order_usa']?>" 
                       class="sh_action_link" style="background: var(--primary-color); color: white">
                      <p>Xác nhận</p>
              </a>
                <?php } else{ ?>
                    <a href="?a=order&pages=unconfirm&dir=list_order_usa&id=<?php echo $order_usa_detail[0]['id_order_usa']?>" 
                       class="sh_action_link" style="background: var(--primary-color); color: white">
                      <p>Hủy xác nhận</p>
              </a>
                <?php }?>
            </div>
            <div class="confirm_delete_prd" id="content_confirm_delete_prd">
              <p>Bạn chắc chắn xóa?</p>
              <button type="submit" onclick="return XacNhanXoa()" style="background: #65b688">
                <a href="?a=order&pages=delete&dir=list_order_usa&id=<?php echo $order_usa_detail[0]['id_order_usa']?>"
                  style="color: white">
                Xác nhận
                </a>
              </button>
              <button id="btn_delete_prd_no" onclick="Hiden_Confirm_Delete()">
                  Hủy  
              </button>
            </div>
        </div>
        <?php
            if(isset($_SESSION['confirm_contact_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã "Xác Nhận" liên hệ thành công.
                    </div>
                </div>
            <?php }
            unset($_SESSION['confirm_contact_success']);
        ?>
        <?php
            if(isset($_SESSION['un_confirm_order_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã "Hủy Xác Nhận" liên hệ thành công.
                    </div>
                </div>
            <?php }
            unset($_SESSION['un_confirm_order_success']);
        ?>

   </div>
</div>
<div class="row space_top_large">
    <div class="col-xs-12" style="margin-bottom: 25px;">
        <div class="col-xs-12 sh_shadow" style="padding: 0">
            <div class="sh_title_list_order">
                <p style="margin-bottom: 0">Thông tin liên hệ</p>
            </div>
                <ul class="sh_content_info_order">
                    <li><p>
                        <span>Tình trạng: </span><?php
                            if($order_usa_detail[0]['onoff_order_usa'] == 0){
                                echo "<span>Chưa xác nhận</span>";
                            }else {
                                echo "<span style='color: var(--primary-color)'>Đã xác nhận</span>";
                            }
                        ?>
                    </p></li>
                    <li><p><span>Khách hàng: </span><span><?php echo $order_usa_detail[0]['name_order_usa']?></span></p></li>
                    <li><p><span>Email: </span><span><?php echo $order_usa_detail[0]['email_order_usa']?></span></p></li>
                    <li><p><span>Số điện thoại: </span><span><?php echo $order_usa_detail[0]['phone_order_usa']?></span></p></li>
                    <li><p><span>Chi tiết: </span></p>
                      <table class="col-xs-12 table-hover table_list_trans">
                          <tr>
                            <td >Link sản phẩm</td>
                            <td>Số lượng</td>
                          </tr>
                            <?php
                              $link_order = explode(" -/- ",$order_usa_detail[0]['link_prd_order_usa']);
                              $qty_order = explode("-",$order_usa_detail[0]['qty_order_usa']);
                            ?>
                            <?php
                              for($i = 0; $i < count($link_order) - 1; $i++){
                                echo '  <tr>
                                <td><a href="'.$link_order[$i].'" target="_blank">Sản phẩm '.($i + 1).'</a></td>
                                        <td>'.$qty_order[$i].'</td>
                                   </tr>';
                              }
                            ?>
                      </table>
                    </li>
                </ul>
        </div>
    </div>
</div>

</div>
</div>
</div>
