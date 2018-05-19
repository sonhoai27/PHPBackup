<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){?>
<title>Q.SHOP - Đặt Hàng</title>
<div class="container">
    <div class="row checkout_page">
        <div class="col-xs-12">
          <?php
            if(isset($_SESSION['alert_notify_order']) == 'NO'){
              echo "<h2 class='text-center' style='color: red; margin-bottom: 15px!important; display: block'>Thất bại</h2>";
            }
            unset($_SESSION['alert_notify_order']);
          ?>
        </div>
        <form action="./mua-hang" method="POST">
        <div class="col-sm-4 show_product_checkout">
            <div class="checkout_title_checkout">
                <h3>Chi tiết đơn hàng</h3>
                <div class="content_shipping_deals">
                    <input type="email" name="checkout_email_buyer" value="" placeholder="Thư điện tử">
                    <input type="text" name="checkout_name_buyer" value="" placeholder="Họ và tên">
                    <input type="text" name="checkout_number_phone_buyer" value="" placeholder="Số điện thoại">
                    <textarea placeholder="Thông tin chi tiết nơi ở hiện tại của bạn, số nhà, số đường..." type="text" name="checkout_address"></textarea>
                </div>
                <div class="content_payment_checkout">
                    <label class="hidden_info_bank">
                        <input type="radio" name="payment_methods" value="Thanh toán sau khi nhận hàng"/>
                        <i></i>
                        <span>Thanh toán sau khi nhận hàng *.</span>
                    </label>
                    <label class="show_info_bank">
                        <input type="radio" name="payment_methods" value="Thanh toán qua chuyển khoản"/>
                        <i></i>
                        <span>Thanh toán qua chuyển khoản.</span>
                    </label>
                    <div class="content_bank_info">
                        <ul>
                            <li>Tên: Nguyễn Đình Quí</li>
                            <li>Số tài khoản: 0071001098775 - Vietcombank</li>
                            <li>Số điện thoại: 0986897939</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 show_product_checkout">
            <div class="checkout_title_checkout">
                <h3>Tổng sản phẩm</h3>
                <div class="content_product_checkout">
                    <table width="100%">
                        <?php
                            if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
                                foreach($_SESSION['cart'] as $prd){ ?>
                                    <tr width="100%">
                                        <td width="20%"><img src="<?php echo $prd['content_img']?>" alt="" style="width: 60%"></td>
                                        <td width="50%"><?php echo $prd['name_watch']?></td>
                                        <td width="30%" style="text-align: right"><?php echo number_format($prd['price_off']).' VND'?><?php echo " (".($prd['qty_watch']).")"?></td>
                                    </tr>
                                <?php }
                            }
                        ?>
                    </table>
                </div>
                <div class="action_link">
                    <a href="./cart"><span>Sửa</span></a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="checkout_order_sammuray">
                <?php
                    $total_order = 0;
                    if(isset($_SESSION['cart']) && $_SESSION['cart'] != NULL){
                        foreach($_SESSION['cart'] as $prd){
                           $total_order += $prd['price_off'];
                        }
                    }
                ?>
                <h3>Đơn giá</h3>
                <p>Tạm tính: <span><?php echo number_format($total_order)." VND"?></span></p>
                <p>Phí giao hàng: <span>0 vnd</span></p>
                <p>Tổng tiền: <span><?php echo number_format($total_order)." VND"?></span></p>
                <input type="text" name="total_order" value="<?php echo $total_order?>" style="display: none;">
                <button type="submit" name="add_order">Thanh Toán</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php }else{ ?>
   <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h3>Bạn chưa có sản phẩm nào để mua hàng.</h3>
                <p><a href="./">Nhấp vào đây để xem các sản phẩm.</a></p>
            </div>
        </div>
   </div>
<?php } ?>

<script>
    $(document).ready(() =>{
        var check_info_bank = false
        $(".show_info_bank").click(() => {
            if(!check_info_bank){
                 $(".content_bank_info").css("display", "block")
                 check_info_bank = true
            }
        })
        $(".hidden_info_bank").click(() => {
            if(check_info_bank){
                $(".content_bank_info").css("display", "none")
                check_info_bank = false
            }
        })
    })
</script>
