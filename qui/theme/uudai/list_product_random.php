<?php
$BASE_URL = "https://dqwatch.com/";
?>
<div class="col-xs-12">
    <div class="container">
      <div class="row">
         <div class="col-sm-3">
            <div class="prds_random">
                <div class="title_list_prd_random">
                    <p>đặc sắc</p>
                </div>
                <div class="list_prds_random">
                    <?php foreach($arr['list_random_prd'] as $products){ ?>
                        <div class="item_prd">
                            <div class="prd_img">
                                <img src="<?php echo $products['content_img']?>" title="<?php echo $products['name_watch']?>" class="img img-responsive">
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
        <div class="col-sm-3">
            <div class="prds_random">
                <div class="title_list_prd_random">
                    <p>sản phẩm mới</p>
                </div>
                <div class="list_prds_random">
                    <?php foreach($arr['list_prd_new'] as $products){ ?>
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
        <div class="col-sm-3">
            <div class="prds_random">
                <div class="title_list_prd_random">
                    <p>Khuyến mãi</p>
                </div>
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
        <div class="col-sm-3">
            <div class="prds_random">
                <div class="title_list_prd_random">
                    <p>xem nhiều</p>
                </div>
                <div class="list_prds_random">
                    <?php foreach($arr['list_viewed_prd'] as $products){ ?>
                        <div class="item_prd">
                          <a href="<?=$BASE_URL?>dong-ho/<?php echo $products['alias_watch']?>-<?php echo $products['id_watch']?>">
                            <img src="<?=$BASE_URL?><?php echo $products['content_img']?>" title="<?php echo $products['name_watch']?>" class="img img-responsive">
                            <p><?php echo $products['name_watch']?></p>
                          </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
      </div>
    </div>
</div>