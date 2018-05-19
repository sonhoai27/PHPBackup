<?php
$req= explode("/",$_SERVER['REQUEST_URI']);
$BASE_URL = "https://dqwatch.com/";
echo "<title>Tìm kiếm cho: ".$_GET['tu-khoa']."</title>";
?>
<div class="col-xs-12 title_search_page">
    <div class="row">
        <div class="container key_search_page">
            <p>Kết quả tìm kiếm cho <strong>'<?=$_GET['tu-khoa']?>'</strong></p>
            <a href="./">Trở về trang chính</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="row list_result_search">
        <div class="prd_result">
            <?php
            foreach ($list_prd as $prd){?>
                <div class="col-sm-3">
                    <div class="product-item">
                        <div class="wrapper-bg">
                            <div class="bg">
                                <img src="<?php echo $prd['content_img']?>" title="<?php echo $prd['name_watch']?>" class="img img-responsive product-image-deals">
                            </div>
                        </div>
                        <div class="title-product">
                            <a href="<?=$BASE_URL?>dong-ho/<?php echo $prd['alias_watch']?>-<?php echo $prd['id_watch'] ?>"><span><?php echo $prd['name_watch']?></span></a>
                        </div>
                        <div class="product-price">
                            <span class="price"><?php echo number_format($prd['price_watch'])?></span>
                            <span class="add_to_cart" id="add_to_cart">
                                <p onclick="Add_To_Car_Main(<?php echo $prd['id_watch']?>)"></p>
                            </span>
                            <span class="product-sale">save <?php echo $prd['sale_watch']?></span>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
        <div class="sh_pagination p12">
        <ul>
            <a href="./tim-kiem/<?=$_GET['ma']."/".$_GET['tu-khoa']?>&trang=<?php
                if(!isset($_GET['trang'])){
                    echo 1;
                }else {
                    if($_GET['trang'] - 1 == 0){
                        echo 1;
                    }else{
                        echo $_GET['trang'] - 1;
                    }
                }
            ?>" style='margin-left: 15px'><li>Trở về</li></a>
            <a href="./tim-kiem/<?=$_GET['ma']."/".$_GET['tu-khoa']?>&trang=<?php
                if(isset($_GET['trang']) && count($list_prd) > 0 && count($list_prd) == 8){
                    echo $_GET['trang'] + 1;
                }else{
                    if(!isset($_GET['trang']) && count($list_prd) > 0 && count($list_prd) == 8){
                        echo 2;
                    }else {
                        echo 1;
                    }
                }
            ?>"><li>Đi tới</li></a>
        </ul>
    </div>
    </div>
</div>
