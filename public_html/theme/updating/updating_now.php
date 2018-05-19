<style type="text/css">
    .wrapper-bg {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 270px;
        margin: auto;
    }
</style>
<?php
$BASE_URL = "http://localhost:8080/public_html/";
//$BASE_URL = "https://sonhoai272.000webhostapp.com/";
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 title_trendding_now">
            <p><b>Bán chạy nhất</b></p>
            <p>Sản phẩm đang bán chạy nhất.</p>
        </div>
        <div class="col-xs-12">
            <div class="product-updating-now content_trendding_now">
                <div class="owl-carousel owl-theme owl-loaded owl-drag">
                    <?php foreach($arr['list_most_viewed_prd'] as $products){ ?>
                        <div class="item">
                            <div class="wrapper-bg">
                                <div class="bg">
                                    <img src="<?php echo $products['content_img']?>" title="<?php echo $products['name_watch']?>" class="img img-responsive product-image-deals">
                                </div>
                            </div>
                            <div class="title-product">
                                <a href="<?=$BASE_URL?>dong-ho/<?php echo $products['alias_watch']?>-<?php echo $products['id_watch']?>"><span><?php echo $products['name_watch']?></span></a>
                            </div>
                            <div class="product-price">
                                <span class="price"><?php echo number_format($products['price_watch']).' VNĐ'?></span>
                                <span class="add_to_cart" id="add_to_cart">
                                <p onclick="Add_To_Car_Main(<?php echo $products['id_watch']?>)"></p>
                            </span>
                                <span class="product-sale">save <?php echo $products['sale_watch'].'%'?></span>
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
</div>