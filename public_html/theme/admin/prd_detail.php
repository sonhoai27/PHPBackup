
<div class="row">
   <div class="col-xs-12">
        <form action="?a=product_c&dir=2" accept-charset="utf-8" method="post">
            <div class="col-xs-12 sh_prd_header_btn_action">
              <div class="sh_title_manager_product">
                  <h2>Chi tiết sản phẩm</h2>
              </div>
              <div class="sh_prd_btn_action">
                  <button type="submit" class="sh_action_submit"><p>Cập nhật</p></button>
                  <a href="?a=admin_product" class="sh_action_link"><p>Hủy</p></a>
              </div>
            </div>
        <div class="col-xs-12 col-sm-10 sh_content_prd_detail">
            <?php $val = $data[0]; ?>
                <div class="sh_content_info_prd">
                    <input type="text" value="<?php echo $val['id_watch']?>" placeholder="Id đồng hồ" style="display: none" name="id-sp">
                    <label for="">Tên</label>
                    <input type="text" value="<?php echo $val['name_watch']?>" placeholder="Tên đồng hồ" name="ten-sp">
                    <label for="">Mã đồng hồ</label>
                    <input type="text" value="<?php echo $val['ksu_watch']?>" placeholder="Mã đồng hồ" name="sku-sp">
                    <label for="">Giá</label>
                    <input type="text" value="<?php echo $val['price_watch']?>" placeholder="Price" name="gia-sp">
                    <label for="" style="color: red">Sale</label>
                    <input type="text" value="<?php echo $val['sale_watch']?>" placeholder="Sale" name="sale-sp">
                    <label for="" style="color: red">Tiền sau giảm giá</label>
                    <input type="text" value="<?php echo number_format(($val['price_watch']) - (($val['price_watch']*$val['sale_watch'])/100)).' vnđ'?>">
                    <label for="">Hãng</label>
                    <select name="hang-sp">
                        <?php foreach($list_brand as $brands){
                            if($brands['id_brand'] == $val['brand_id']){ ?>
                                <option value="<?php echo $brands['id_brand']?>" selected><?php echo $brands['name_brand']?></option>
                            <?php }else{?>
                                <option value="<?php echo $brands['id_brand']?>"><?php echo $brands['name_brand']?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label for="">Màu</label>
                    <input type="text" value="<?php echo $val['color_watch']?>" placeholder="Color" name="mau-sp">
                    <label for="">Giới tính</label>
                    <select name="gioi-tinh">
                        <?php foreach($list_sex as $sex){
                            if($sex['id_sex'] == $val['sex_watch']){ ?>
                                <option value="<?php echo $sex['id_sex']?>" selected><?php echo $sex['name_sex']?></option>
                            <?php }else{?>
                                <option value="<?php echo $sex['id_sex']?>"><?php echo $sex['name_sex']?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <label for="">Kích thước</label>
                    <input type="text" value="<?php echo $val['size_watch']?>" placeholder="Size" name="size-sp">
                    <label for="">Thông tin thêm</label>
                    <div class="sonH_editor">
                        <b>
                        <span class="tag_b">&ltb&gt</span>
                        <span class="tag_u">&ltu&gt</span>
                        <span class="tag_i">&lti&gt</span>
                        <span class="tag_br">&ltbr&gt</span>
                        </b>
                    </div>
                    <textarea class="sh_more_info_prd" name="info-sp" placeholder="Thông tin sản phẩm" ><?php echo $val['info_watch']?></textarea>
                    <label for="">Hình ảnh</label>
                </div>
                </form>
                <div class="sh_show_img_detail_prd col-xs-12" style="padding-left: 0px">
                    <?php
                        $arr_img = explode(',',$val['Array_Img']);
                        for($i = 0; $i < count($arr_img); $i++) {
                            $item_img = explode(':', $arr_img[$i]); ?>
                                <form id="uploadimage_<?php echo $i?>" method="POST" enctype="multipart/form-data" class="input_file_container" >
                                    <div class="sh_img_preview">
                                        <img src="<?php echo $item_img[1]?>" class="img img-responsive sh_prd_d1" id="prd_d_img_<?php echo $i?>" />
                                        <input type="file" name="img-sp-1" class="input_file">
                                        <input type="text" name="id_prd" class="display_hidden" value="key <?php echo $item_img[0]?> img">
                                    </div>
                                    <input type="submit" name="update-img" id="prd_id_1" value="Update">
                                </form>
                        <?php }?>
                </div>
        </div>
   </div> 
</div>
</div>
</div>
</div>