<?php
$main_title = $prd_detail[0]['name_watch'];
echo "<title>".$main_title."</title>";
?>
<script type="text/javascript">
    // change img prd
    function ChangeImg(id) {
        $("#large_img_prd_1").attr('src', $("#small_img_prd_" + id).prop('src'))
        $("#large_img_prd_2").attr('src', $("#small_img_prd_" + id).prop('src'))
    }
</script>
<div class="container content-product-detail">
   <?php
    foreach($prd_detail as $pd){
    $id_prd = $pd['id_watch'];
    $arr_img = explode(',',$pd['Array_Img']);
    ?>
        <div class="row">
            <!-- <div class="col-xs-12 sh_title"><p>Thông tin sản phẩm</p></div> -->
          <div class="col-sm-6 col-xs-12">
            <div class="content-img">
              <div id="zoom-img">
                <img src="<?php echo $pd['content_img']?>" title="<?php echo $pd['name_watch']?>" class="img img-responsive img_prd_hover" id="large_img_prd_1">
                <!-- <img src="<?php echo $pd['content_img']?>" title="<?php echo $pd['name_watch']?>" class="zoomed" id="large_img_prd_2"> -->
              </div>
            </div>
              <div class="content-list-img">
                  <?php for($i = 0; $i < count($arr_img); $i++) {
                    $item_img = explode(':', $arr_img[$i]); ?>
                      <img src="<?php echo $item_img[1]?>" title="<?php echo $pd['name_watch']?>" class="img img-responsive" id="small_img_prd_<?php echo $i + 1?>" onclick="ChangeImg(<?=$i + 1?>);">
                  <?php }?>
              </div>
          </div>
          <div class="col-sm-6 col-xs-12">
              <div class="content-main-info">
                  <div class="product-info-name">
                      <h2><?php echo $pd['name_watch']?></h2>
                  </div>
                  <div class="product-main-brand">
                      <a href="./dong-ho/hang/<?=$pd['alias_brand']?>"><p><?php echo $pd['name_brand']?></p></a>
                  </div>
                  <div class="num-id-product">
                      <p>SKU: DW<?= $pd['id_watch']?></p>
                  </div>
                  <div class="product-main-retail-price">
                    <p style="display: block"><?php echo "Retail: ".number_format($pd['price_watch'])." ".'VND'?></p>
                  </div>
                  <div class="product-main-price">
                      <span class="product-detail-price"><?php echo number_format(($pd['price_watch']) - (($pd['price_watch']*$pd['sale_watch'])/100))." "."VND"?></span>
                      <span class="product-detail-sale">(<?php echo $pd['sale_watch']?>% off)</span>
                  </div>
                  <div class="prd_content_desc">
<!--                      <p>Giới tính: --><?php //echo $pd['name_sex']?><!-- - Màu:  --><?php //echo $pd['color_watch']?><!--</p>-->
                      <pre style="
                        padding: 0px;
                        border: 0px;
                        background: #fff;
                        font-size: 14px;
                        border-radius: 0;
                       "><?= $pd['info_watch']?>
                      </pre>
                  </div>
                  <div class="btn-buy-product">
                      <?php
                      if($pd['switch_watch'] == 0){?>
                          <button class="btn" id="add_to_cart"><p>Thêm vào giỏ hàng</p></button>
                      <?php } ?>
                      <button class="btn" id="add_call_me"><p>Liên hệ</p></button>
                      <div class="form_content_contact_me" style="display: none;">
                          <form method="post" id="form_submit_contact_info">
                              <input type="text" name="id_prd" value="<?=$pd['id_watch']?>" style="display: none">
                              <input type="text" placeholder="Tên của bạn" name="your_name_contact" id="your_name_contact">
                              <input type="email" placeholder="Email hoặc số điện thoại của bạn" name="your_email_phone_contact" id="your_email_phone_contact">
                              <textarea id="content_info_contact" type="text" name="content_info_contact">Tôi muốn tư vấn về đồng hồ <?= $pd['name_watch']?>.
Có mã SKU: DW<?=$pd['id_watch']?>
                              </textarea>
                              <button name="submit_form_contact" type="submit">Gửi</button>
                          </form>
                      </div>
                      <p class="prd_switch_watch"><?php
                          if($pd['switch_watch'] == 0){
                              echo "Còn hàng.";
                          }else{
                              echo "Hết hàng.";
                          }
                          ?></p>
                  </div>
                    <div class="list_social">
                        <span style="font-size: 20px">Share This </span>
                        <ul>
                            <li style="margin-left: 15px;"><span>facebook</span></li>
                            <li><span>twitter</span></li>
                            <li><span>email</span></li>
                        </ul>
                    </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-sm-6">
              <div class="product-main-desc">
                 <div class="main_info_prd">
                     <h3>Thông tin sản phẩm</h3>
                     <ul>
                         <li><span>Giới tính:</span> <?= $pd['name_sex']?></li>
                         <li><span>Màu sắc: </span> <?= $pd['color_watch']?></li>
                         <li><span>Kích thước:</span> <?= $pd['size_watch']?>mm</li>
                         <li><span>Hãng:</span> <?= $pd['name_brand']?></li>
                     </ul>
                 </div>
                 <h3>Chế độ bảo hành</h3>
                  <span style="margin:10px 0 15px 0; display: block">
                      Sau khi mua hàng trong vòng 03 ngày, nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất, chúng tôi cam kết đổi sản phẩm mới cho khách hàng. Ngoài ra, trong thời gian bảo hành, nếu sản phẩm được xác định có lỗi từ phía nhà sản xuất mà không thể khắc phục được, QSHOP sẽ đổi sản phẩm mới cho quý khách.
                     Xem thêm chi tiết chính sách bảo hành, đổi trả  <a href="">tại đây</a>.
                  </span>
                 <h3>Giao hàng</h3>
                  <span style="margin:10px 0 15px 0; display: block">Giao hàng miễn phí tại thành phố Hồ Chí Minh, tại các tỉnh thành khác vui lòng xem bảng giá giao hàng tại
                      <a href="">đây</a>.</span>
              </div>
          </div>
      </div>
        <div class="row" style="margin-top: 40px">
            <?php require_once ("./theme/uudai/list_product_random.php");?>
        </div>
    <?php } ?>
</div>
<div class="analog_modal_content">
    <div class="analog_modal">
        <div class="disable_btn">
            <span>x</span>
        </div>
        <img src="" alt="" class=" modal_img">
    </div>
</div>
<script>
    $(document).ready(()=> {
        $('#add_to_cart').click(() => {
            var numberCart = <?php
              if(isset($_SESSION['cart'])){
                 echo UpdateNumberPrdCart($_SESSION['cart'], $id_prd);
              }else{
                echo 1;
              }
            ?>;
            $.post("./res_st.php?a=add_to_cart",{id_sp: <?php echo $id_prd ?>}, data => {
                if(data == "THANH_CONG"){
                    $('.toast').addClass('on');
                    setTimeout(function(next) {
                        $('.toast').removeClass('on')
                        $(".sum_item_car").html(numberCart)
                    }, 2500);
                }
            })
        })
    })

</script>
