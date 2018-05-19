<div class="row">
    <div class="col-xs-12">
        <div class="sh_title_manager_product">
            <h2>Thiết lập</h2>
        </div>
        <div class="sh_content_alert">
            <?php if(isset($_SESSION['delete_success'])){?>
                <div class="alert alert-success">
                    <strong>Xóa thành công!</strong>
                </div>
            <?php }
                unset($_SESSION['delete_success'])
            ?>
        </div>
    </div>
    <div class="col-xs-12 space_left_right" style="margin-top: 80px">
        <div class="col-sm-6 col-xs-12">
           <div class="sh_border_content">
               <div class="sh_title_list_order">
                   <p style="margin-bottom: 0">Hãng đồng hồ</p>
               </div>
               <div class="sh_settings_btn_action">
                   <form action="?a=settings&pages=delete_brand" method="post" id="form_delete_brand">
                       <input type="text" value="" name="arr_id_brand" id="sh_delete_brand" style="display: none;">
                       <button type="submit" name="btn_detele_brand" class="sh_action_submit sh_btn_delete_brand" style="background: #ff3b30">Xóa</button>
                   </form>
                   <button class="sh_action_submit sh_btn_add_new_brand"><p>Thêm</p></button>
                   <p id="sh_alert_action" style="color: var(--primary-color)">Thêm Thành Công!</p>
               </div>

               <div class="sh_add_new_brand">
                   <p style="font-size: 18px; font-weight: 600">Thêm hãng mới.</p>
                   <form action="" method="post" id="form_add_new_brand">
                       <input type="text" placeholder="Nhập tên hãng" value="" name="name_brand" id="sh_input_name_brand">
                       <input type="text" value="" readonly name="alias_brand" placeholder="Alias" id="sh_input_alias_brand">
                       <button class="sh_action_submit" id="sh_btn_cancel_new_brand" style="background: #ff3b30"><p>Hủy</p></button>
                       <button type="submit" name="add_new_brand">Thêm</button>
                   </form>
               </div>
               <div class="sh_content_manager_brand">
                   <table width="100%" id="table_list_brand">

                       <?php foreach ($brand as $hang){?>
                           <tr>
                               <td width="25%">
                                   <input
                                   id="brand_<?php echo $hang['id_brand']?>"
                                   name ="brand_item_<?php echo $hang['id_brand']?>"
                                   type="checkbox" class="sh_btn_checkbox"
                                   onclick = "DeleteBrandId(<?php echo $hang['id_brand']?>)">
                                   <label for="brand_<?php echo $hang['id_brand']?>"  class="sh_checkbox_label"></label></td>
                               <td width="50%"><p><?php echo $hang['name_brand']?></p></td>
                               <td width="25%"><p>Sửa</p></td>
                           </tr>
                       <?php }?>

                   </table>
               </div>
               <div class="sh_pagination p12">
                   <p id="sh_pg_alert_action" style="color: #ff3b30; display: none">Cảnh báo!. Trang cuối!</p>
                   <ul>
                       <a id="pg_brand_pre"><li>Previous</li></a>
                       <a id="pg_brand_next"><li>Next</li></a>
                   </ul>
               </div>
           </div>
        </div>
        <div class="col-sm-6 col-xs-12">
            <div class="sh_border_content">
                <div class="sh_title_list_order">
                    <p style="margin-bottom: 0">Giới tính</p>
                </div>
                <div class="sh_content_manager_brand">
                    ahaha
                </div>
            </div>
        </div>
    </div>
</div>

</div>
</div>