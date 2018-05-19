<div class="row" style="margin-bottom: 50px">
   <div class="col-xs-12">
        <form action="?a=product_c&dir=1" accept-charset="utf-8" method="post" enctype="multipart/form-data">
            <div class="col-xs-12 sh_prd_header_btn_action">
              <div class="sh_title_manager_product">
                  <h2>Thêm mới</h2>
              </div>
              <div class="sh_prd_btn_action">
                  <a href="?a=admin_product" class="sh_action_link"><p>Hủy</p></a>
                  <button type="submit" class="sh_action_submit"><p>Thêm</p></button>
              </div>
            </div>
        <?php
            if(isset($_SESSION["SH_ERROR_ADD_NEW"])){?>
                <div class="col-xs-12" style="margin-top: 25px;">
                    <div class="alert alert-warning">
                        <strong>Warning!</strong> Có lỗi trong quá trình thêm sản phẩm mới như là:
                        <ul type="none">
                            <li>Upload hình.</li>
                            <li>Không điền tên sản phẩm.</li>
                            <li>Không điền giá sản phẩm.</li>
                            <li>...</li>
                        </ul>
                    </div>
                </div>
        <?php } ?>
        <div class="col-xs-12 col-sm-8 sh_content_prd_detail">
            <div class="sh_content_info_prd">
                <label for="">Tên</label>
                <input type="text" placeholder="Name" name="ten-sp"  id="sh_input_name_brand">
                <label for="">Mã đồng hồ</label>
                <input type="text" placeholder="Mã đồng hồ" name="ksu-sp">
                <label for="" style="display: none;">Alias</label>
                <input type="text" placeholder="Alias" readonly name="alias-sp" id="sh_input_alias_brand">
                <label for="">Giá</label>
                <input type="text" placeholder="Price" name="gia-sp" id="sh_price_prd">
                <label for="" style="color: red">Sale</label>
                <input type="text" placeholder="Sale" name="sale-sp" id="sh_sale_prd">
                <label for="" style="color: red">Giá sau sale</label>
                <input type="text" id="price_of_sale">
                <label for="">Hãng</label>
                <!--<input type="text"  placeholder="Brand" name="hang-sp">-->
                <select name="hang-sp">
                    <?php foreach($list_brand as $brands){?>
                        <option value="<?php echo $brands['id_brand']?>"><?php echo $brands['name_brand']?></option>
                    <?php } ?>
                </select>
                <label for="">Giới tính</label>
                <select name="gioi-tinh">
                    <?php foreach($list_sex as $sex){?>
                        <option value="<?php echo $sex['id_sex']?>"><?php echo $sex['name_sex']?></option>
                    <?php } ?>
                </select>
                <label for="">Màu</label>
                <input type="text"  placeholder="Color" name="mau-sp">
                <label for="">Kích thước</label>
                <input type="text" placeholder="Size" name="size-sp">
                <label for="">Thông tin thêm</label>
                <textarea name="info-sp" placeholder="Thông tin sản phẩm"></textarea>
            </div>
            <div class="sh_add_img_upload col-xs-12" style="padding-left: 0px">
                <p><b>Upload ảnh</b></p>
                <div class="sh_input_file_upload">
                    <input type="file" name="img-sp[]" multiple id="img-sp" class="input_file">
                </div>
<!--                <i class="fa fa-plus" aria-hidden="true" id="sh_add_new_btn_upload_img"></i>-->
            </div>
            </form>
        </div>
   </div>
</div>
</div>
</div>
</div>
