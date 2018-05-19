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
<div class="confirm_delete_prd" id="content_confirm_delete_prd">
  <p>Bạn chắc chắn xóa?</p>
  <button type="submit" onclick="return XacNhanXoa()" style="background: #65b688">
    <a href="?a=order&pages=delete&dir=order&id=<?php echo $get_order[0]['id_order']?>"
      style="color: white">
    Xác nhận
    </a>
  </button>
  <button id="btn_delete_prd_no" onclick="Hiden_Confirm_Delete()">
      Hủy  
  </button>
</div>
<div class="row">
   <div class="col-xs-12">
        <div class="col-xs-12 sh_prd_header_btn_action">
            <div class="sh_title_manager_product">
                <h1>Chi tiết đơn hàng</h1>
                <div class="sh_content_total_order">
                    <p>Thời gian: <?php echo $get_order[0]['date_order']?></p>
                    <span>Tổng tiền: </span><span style="color: var(--primary-color);"><?php echo number_format($get_order[0]['total_order'])." VND"?></span>
                </div>
            </div>
            <div class="sh_prd_btn_action">
                <a href="?a=order&pages=list_order" class="sh_action_link"><p>Thoát</p></a>
                <a class="sh_action_link" onclick="return KiemTraXoa()">
                  <p>Xóa</p>
                </a>
                <?php if($get_order[0]['status_order'] == 0){?>
                    <a href="?a=order&pages=confirm&dir=order&id=<?php echo $get_order[0]['id_order']?>" class="sh_action_link" style="background: var(--primary-color); color: white"><p>Xác nhận</p></a>
                <?php } else{ ?>
                    <a href="?a=order&pages=unconfirm&dir=order&id=<?php echo $get_order[0]['id_order']?>" class="sh_action_link" style="background: var(--primary-color); color: white"><p>Hủy xác nhận</p></a>
                <?php }?>
            </div>
        </div>
        <?php
            if(isset($_SESSION['confirm_order_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã "Xác Nhận" hóa đơn thành công.
                    </div>
                </div>
            <?php }
            unset($_SESSION['confirm_order_success']);
        ?>
        <?php
            if(isset($_SESSION['un_confirm_order_success'])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-success">
                        <strong>Chúc mừng!</strong>. Đã "Hủy Xác Nhận" hóa đơn thành công.
                    </div>
                </div>
            <?php }
            unset($_SESSION['un_confirm_order_success']);
        ?>

   </div>
</div>
<div class="row space_top_large">
    <div class="col-xs-12 col-sm-6" style="margin-bottom: 25px;">
        <div class="col-xs-12 sh_shadow" style="padding: 0">
            <div class="sh_title_list_order">
                <p style="margin-bottom: 0">Thông tin đơn hàng</p>
            </div>
            <div class="sh_content_info_order">
                <ul>
                <?php foreach($get_order as $order){?>
                    <li><p>
                        <span>Tình trạng: </span><?php
                            if($order['status_order'] == 0){
                                echo "<span>Chưa xác nhận</span>";
                            }else {
                                echo "<span style='color: var(--primary-color)'>Đã xác nhận</span>";
                            }
                        ?>
                    </p></li>
                    <li><p><span>Khách hàng: </span><span><?php echo $order['name_buyer']?></span></p></li>
                    <li><p><span>Email: </span><span><?php echo $order['email_buyer']?></span></p></li>
                    <li><p><span>Số điện thoại: </span><span><?php echo $order['number_buyer']?></span></p></li>
                    <li><p><span>Địa chỉ: </span><span><?php echo $order['address_buyer']?></span></p></li>
                    <li><p><span>Phuong thức thanh toán: </span><span><?php echo $order['payment_order']?></span></p></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="col-xs-12 sh_shadow" style="padding: 0">
            <div class="sh_title_list_order sh_shadow">
                <p style="margin-bottom: 0">Sản phẩm của đơn hàng</p>
            </div>
            <div class="sh_content_product_order">
                <table width="100%">
                    <?php foreach($prd_order as $sp){?>
                        <tr width="100%">
                            <td width="20%"><img src="<?php echo $sp['img_watch']?>" alt="" style="width: 60%"></td>
                            <td width="50%"><a href="admin?a=prd_detail&id=<?php echo $sp['id_watch']?>"><?php echo $sp['name_watch']?></a></td>
                            <td width="30%" style="text-align: right"><?php echo  number_format($sp['price_watch_off'])." VND"?><?php echo " (".($sp['qty_watch']).")"?></td>
                        </tr>
                   <?php } ?>
                </table>
                <div class="sh_content_total_order">
                    <span>Tổng tiền: </span><span style="color: var(--primary-color);"><?php echo number_format($get_order[0]['total_order'])." VND"?></span>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>
