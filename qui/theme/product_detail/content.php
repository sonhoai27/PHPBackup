<?php
$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$main_title = $prd_detail[0]['name_watch'];
$BASE_URL = "https://dqwatch.com/";
echo "<title>".$main_title."</title>";
?>
<meta property="og:title" content="<?=$main_title?>" />
				<meta property="og:type" content="Website" /> 
				<meta property="og:url" content="<?=$actual_link?>" />
				<meta property="og:image"  content="<?php echo $BASE_URL.strstr($prd_detail[0]['content_img'], "public")?>"/>
				<meta property="og:description" content="DWQatch - Đông hồ chính hãng" />
<div class="container content-product-detail">
    <div class="row">
        <?php
        foreach($prd_detail as $pd){
        $id_prd = $pd['id_watch'];
        $arr_img = explode(',',$pd['Array_Img']);
        ?>
        <div class="col-sm-12">
            <div class="row">
								<div class="col-sm-9">
										<div class="product-info-name">
												<h2><?php echo $pd['name_watch']?></h2>
										</div>
										<div class="product-main-brand">
												<a href="./dong-ho/hang/<?=$pd['alias_brand']?>"><p>Thương hiệu: <?php echo $pd['name_brand']?></p></a>
										</div>
								</div>
								<div class="col-sm-3">
									<div class="list_social">
											<ul>
													<li>
													 <div class="fb-like"
																data-href="<?=$actual_link ?>"
																data-layout="button"
																data-action="like"
																data-size="small"
																data-show-faces="false"
																data-share="false">
													</div>
												</li>
												<li>
													<div class="fb-share-button"
															 data-href="<?=$actual_link ?>"
															 data-layout="button_count"
															 data-size="small"
															 data-mobile-iframe="true">
														<a class="fb-xfbml-parse-ignore"
															 target="_blank"
															 href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Chia sẻ</a>
													</div>
												</li>
											</ul>
                   </div>
								</div>
                <div class="col-sm-4 col-xs-12 prd_list_img">
                    <div class="content-img">
                        <div id="zoom-img">
                            <img src="https://dqwatch.com/thumb.php?src=https://dqwatch.com/<?php echo $pd['content_img']?>&w=350&h=350" title="<?php echo $pd['name_watch']?>"
                                 class="img img-responsive img_prd_hover" id="large_img_prd_1"
                                 data-zoom-image="<?php echo $pd['content_img']?>" title="<?php echo $pd['name_watch']?>"
                                 >
                            <!-- <img src="<?php echo $pd['content_img']?>" title="<?php echo $pd['name_watch']?>" class="zoomed" id="large_img_prd_2"> -->
                        </div>
                    </div>
                    <div class="content-list-img">
                        <?php for($i = 0; $i < count($arr_img); $i++) {
                            $item_img = explode(':', $arr_img[$i]); ?>
                            <img src="<?php echo $item_img[1]?>" title="<?php echo $pd['name_watch']?>" class="img img-responsive" id="small_img_prd_<?php echo $i + 1?>" onclick="ChangeImg(<?=$i + 1?>);"
                              data-zoom-image="<?php echo $item_img[1]?>"  
                                 >
                        <?php }?>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12">
                    <div class="content-main-info">
												<p>Bảo hành: trọn đời Bằng Hóa đơn mua hàng</p>
												<div class="main_info_prd">
													<ul>
															<li><span>SKU:</span> <?= $pd['ksu_watch']?></li>
															<li><span>Giới tính:</span> <?= $pd['name_sex']?></li>
															<li><span>Màu sắc: </span> <?= $pd['color_watch']?></li>
															<li><span>Kích thước:</span> <?= $pd['size_watch']?>mm</li>
															<li><span>Hãng:</span> <?= $pd['name_brand']?></li>
													</ul>
                         </div>
                        <div class="product-main-retail-price">
                            <p style="display: block">Giá trước đây: <?php echo number_format($pd['price_watch'])." ".'VND'?></p>
                        </div>
                        <div class="product-main-price">
                            <span class="product-detail-price"><?php echo number_format(($pd['price_watch']) - (($pd['price_watch']*$pd['sale_watch'])/100))." "."VND"?></span>
                            <span class="product-detail-sale">Tiết kiệm (<?php echo $pd['sale_watch']?> %)</span>
                        </div>
                        <div class="btn-buy-product">
                            <?php
                            if($pd['switch_watch'] == 0){?>
                                <button class="btn" id="add_to_cart"><p>Mua ngay</p></button>
                            <?php } ?>
                            <button class="btn" id="add_call_me"><p>Liên hệ</p></button>
                          <div class="analog_modal_content">
                              <div class="analog_modal">
                                  <div class="disable_btn">
                                      <span>x</span>
                                  </div>
																	<h2>Liên hệ</h2>
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
                              </div>
                          </div>
                            <p class="prd_switch_watch"><?php
                                if($pd['switch_watch'] == 0){
                                    echo "Còn hàng.";
                                }else{
                                    echo "Hết hàng.";
                                }
                                ?></p>
                        </div>
                    </div>
                </div>
								<div class="col-sm-3 prd_detail_info">
									<div class="item">
										<div class="title">
											Thông tin giao hàng.
										</div>
										<div class="content">
											Miễn phí tại Hồ Chí Minh.<br>
											Tại các tỉnh thành khác vui lòng xem tại 
            					<a href="">đây</a>
										</div>
									</div>
									<div class="item">
										<div class="content">
											<ul>
												<li>Bảo hành trọn đời bằng hóa đơn</li>
												<li>Một đổi một nếu có lỗi (hợp lý)</li>
												<li>Thanh toán khi nhận hàng hoặc ngân hàng</li>
											</ul>
										</div>
									</div>
									<div class="item">
										<div class="content">
											<a href="./giup-do#guarantee_help">
												<img src="https://vn-live.slatic.net/cms/2017/9-Sep/warranty-VN.jpg" alt="" class="img img-responsive">
											</a>
										</div>
									</div>
								</div>
            </div>
        </div>
        <div class="col-xs-12" style="margin-bottom: 80px; margin-top: 80px;">
            <div class="row">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="product-main-desc">
															<h3>Thông tin sản phẩm</h3>
                                <div class="prd_content_desc">
                                    <pre style="
                                      padding: 0px;
                                      border: 0px;
                                      background: var(--mau-trang-nhat);
                                      font-size: 14px;
                                      border-radius: 0;
                                     "><?= $pd['info_watch']?>
                                    </pre>
                                  </div>
                                <h3>Chế độ bảo hành</h3>
                                <span style="margin:10px 0 15px 0; display: block">
                Sau khi mua hàng trong vòng 03 ngày, nếu sản phẩm bị lỗi kỹ thuật từ nhà sản xuất, chúng tôi cam kết đổi sản phẩm mới cho khách hàng. Ngoài ra, trong thời gian bảo hành, nếu sản phẩm được xác định có lỗi từ phía nhà sản xuất mà không thể khắc phục được,
																	ĐQWatch sẽ đổi sản phẩm mới cho quý khách.
               Xem thêm chi tiết chính sách bảo hành, đổi trả  <a href="">tại đây</a>.
            </span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="margin-top: 15px; margin-left: 10px;">
                            <div class="fb-comments row" data-href="<?=$actual_link ?>" data-numposts="5"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 list_auto_prd">
                    <h3 style="display: block;margin-bottom: 15px!important;">Có thể bạn thích</h3>
                    <div class="list_prds_random">
                        <?php foreach($arr['list_sale_prd'] as $products){ ?>
                            <div class="item_prd">
                                <div class="prd_img">
                                    <img src="<?=$BASE_URL?><?php echo $products['content_img']?>" title="<?php echo $products['name_watch']?>" class="img img-responsive">
                                </div>
                                <div class="title_product">
                                    <p><a href="<?=$BASE_URL?>dong-ho/<?php echo $products['alias_watch']?>-<?php echo $products['id_watch']?>"><?php echo $products['name_watch']?></a></p>
                                    <p><?php echo number_format($products['price_watch'])?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--         <div class="row" style="margin-top: 40px">
            <?php require_once ("./theme/uudai/list_product_random.php");?>
        </div> -->
    <?php } ?>
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
$("#large_img_prd_1").elevateZoom({
      zoomWindowFadeIn: 550,
			zoomWindowFadeOut: 550,
			lensFadeIn: 550,
			lensFadeOut: 550});

  function ChangeImg(id) {
    var zoomConfig = {
      zoomWindowFadeIn: 550,
			zoomWindowFadeOut: 550,
			lensFadeIn: 550,
			lensFadeOut: 550}; 
    var zoomImage = $('#large_img_prd_1');
    $("#large_img_prd_1").attr('src', $("#small_img_prd_" + id).prop('src'))
    $("#large_img_prd_1").attr('data-zoom-image', $("#small_img_prd_" + id).prop('src'))
    $('.zoomContainer').remove();
    zoomImage.removeData('elevateZoom');
    zoomImage.data('zoom-image', $("#small_img_prd_" + id).prop('src'));
    zoomImage.elevateZoom(zoomConfig);
}
</script>
