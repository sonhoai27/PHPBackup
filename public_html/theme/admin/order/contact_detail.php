<div class="row">
   <div class="col-xs-12">
        <div class="col-xs-12 sh_prd_header_btn_action">
            <div class="sh_title_manager_product">
                <h1>Chi tiết liên hệ</h1>
                <div class="sh_content_total_order">
                    <p>Khách hàng: <?php echo $contact_detail['name_cus_contact_us']?></p>
                    <span>Email/SĐT: </span><span style="color: var(--primary-color);"><?php echo $contact_detail['email_phone_contact_us']?></span>
                </div>
            </div>
            <div class="sh_prd_btn_action">
                <a href="?a=order&pages=contacts" class="sh_action_link"><p>Thoát</p></a>
                <a href="?a=order&pages=delete&dir=contact&id=<?php echo $contact_detail['id_contact_us']?>" class="sh_action_link"><p>Xóa</p></a>
                <?php if($contact_detail['viewed_contact_us'] == 0){?>
                    <a href="?a=order&pages=confirm&dir=contact&id=<?php echo $contact_detail['id_contact_us']?>" class="sh_action_link" style="background: var(--primary-color); color: white"><p>Xác nhận</p></a>
                <?php } else{ ?>
                    <a href="?a=order&pages=unconfirm&dir=contact&id=<?php echo $contact_detail['id_contact_us']?>" class="sh_action_link" style="background: var(--primary-color); color: white"><p>Hủy xác nhận</p></a>
                <?php }?>
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
                            if($contact_detail['viewed_contact_us'] == 0){
                                echo "<span>Chưa xác nhận</span>";
                            }else {
                                echo "<span style='color: var(--primary-color)'>Đã xác nhận</span>";
                            }
                        ?>
                    </p></li>
                    <li><p><span>Khách hàng: </span><span><?php echo $contact_detail['name_cus_contact_us']?></span></p></li>
                    <li><p><span>Email - SĐT: </span><span><?php echo $contact_detail['email_phone_contact_us']?></span></p></li>
                    <li><p><span>Thông tin: </span><span><?php echo $contact_detail['info_contact_us']?></span></p></li>
                </ul>
        </div>
    </div>
</div>

</div>
</div>
</div>
