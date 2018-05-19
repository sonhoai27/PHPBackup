<?php
$link= explode("/",$_SERVER['REQUEST_URI']);
$BASE_URL = "https://dqwatch.com/";
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 title_trendding_now">
            <p><b>Khuyến Mãi</b></p>
            <p>Sản phẩm đang giảm giá.</p>
        </div>
        <div class="col-sm-12 content_trendding_now" style="margin-bottom: 80px;">
            <div class="owl-carousel owl-theme owl-loaded owl-drag">
                <?php foreach($arr['list_sale_prd_unlimit'] as $products){ ?>
                    <div class="item sale_home">
                        <a href="<?=$BASE_URL?>dong-ho/<?php echo $products['alias_watch']?>-<?php echo $products['id_watch'] ?>">

                                  <img src="https://dqwatch.com/thumb.php?src=<?=$BASE_URL?><?php echo $products['content_img']?>&w=250&h=250" title="<?php echo $products['name_watch']?>" class="img img-responsive product-image-deals">

                          <div class="title-product">
                              <span><?php echo $products['name_watch']?></span>
                          </div>
                        </a>
                        <div class="product-price">
                            <span class="price">
                              <?php echo number_format(($products['price_watch']) - (($products['price_watch']*$products['sale_watch'])/100)).' VNĐ'?>
                            </span>
                            <span class="add_to_cart" id="add_to_cart">
                                <p onclick="Add_To_Car_Main(<?php echo $products['id_watch']?>)"></p>
                            </span>
                            <span class="product-sale" style="color: red">save <?php echo $products['sale_watch'].'%'?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <script>
                $(document).ready(function() {
                    var owl = $('.owl-carousel');
                    owl.owlCarousel({
                        items: 4,
                        loop:true,
                        margin:50,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
                        responsiveClass:true,
                        responsive:{
                            0:{
                                items:1,
                                nav:false,
                                loop:true
                            },
                            600:{
                                items:2,
                                nav:false,
                                loop:true
                            },
                            1000:{
                                items:4,
                                nav:true,
                                loop:true,
                                dots: false,
                            }
                        }
                    });
                })
            </script>
        </div>
    </div>
</div>
