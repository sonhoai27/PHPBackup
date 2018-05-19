<?php
$link= explode("/",$_SERVER['REQUEST_URI']);
$BASE_URL = "http://localhost:8080/public_html/";
//$BASE_URL = "https://sonhoai272.000webhostapp.com/";
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 title_trendding_now">
            <p>Đồng hồ</p>
            <p>Bạn đang xem ở chế độ mặc định.</p>
        </div>
        <div class="col-sm-4 col-xs-12" >
            <div class="product_filter">
                <ul>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b class="caret"></b>
                            Hãng
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($list_brand as $brands){?>
                                <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/hang/<?php echo $brands['alias_brand']?>"><?php echo $brands['name_brand']?></a></p></li>
                            <?php }?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b class="caret"></b>
                            Phái
                        </a>
                        <ul class="dropdown-menu">
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gioi-tinh/nam">Nam</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gioi-tinh/nu">Nữ</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gioi-tinh/unisex">Unisex</a></p></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b class="caret"></b>
                            Giá
                        </a>
                        <ul class="dropdown-menu">
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gia/4">Dưới 5 triệu</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gia/5">Trên 5 triệu</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gia/10">Trên 10 triệu</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/gia/20">Trên 20 triệu</a></p></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <b class="caret"></b>
                            Lọc
                        </a>
                        <ul class="dropdown-menu">
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/loc/xem-nhieu">Xem nhiều nhất</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/loc/gia-thap-cao">Giá từ thấp đến cao</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/loc/gia-cao-thap">Giá từ cao đến thấp</a></p></li>
                            <li><p><a href="<?=$BASE_URL?><?=$link[2]?>/loc/giam-gia">Giảm giá</a></p></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="list-products">
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
                            <span><a href="<?=$BASE_URL?>dong-ho/<?php echo $prd['alias_watch']?>-<?php echo $prd['id_watch'] ?>"><?php echo $prd['name_watch']?></a></span>
                        </div>
                        <div class="product-price">
                            <span class="price"><?php echo number_format(($prd['price_watch']) - (($prd['price_watch']*$prd['sale_watch'])/100)).' VNĐ'?></span>
                            <span class="add_to_cart" id="add_to_cart">
                                <p onclick="Add_To_Car_Main(<?php echo $prd['id_watch']?>)"></p>
                            </span>
                            <span class="product-sale">save <?php echo $prd['sale_watch'].'%'?></span>
                        </div>

                    </div>
                </div>
            <?php }?>

        </div>
        <div class="col-sm-12">
            <div class="btn-load-more" style="text-align: center">
                <?php
                $filter = isset($_GET['filter']) ? $_GET['filter'] : "";
                $name_brand = isset($_GET['name']) ? $_GET['name'] : "";
                $price = isset($_GET['from']) ? $_GET['from'] : "";
                $sex = isset($_GET['sex']) ? $_GET['sex'] : "";
                $ct = isset($_GET['ct']) ? $_GET['ct'] : "";
                if($filter == ""){
                    echo "<button onclick='Load_More_Prd()'>Tải thêm</button>";
                }else{
                    if($filter != ""){
                        switch ($filter){
                            case "hang" : {
                                if($name_brand != ""){
                                    echo "<button onclick='Load_More_Prd(`".$name_brand."`)'>Tải thêm</button>";
                                }
                            };break;
                            case "gioi-tinh" : {
                                if ($sex != ""){
                                    echo "<button onclick='Load_More_Prd(``,``, `".$sex."`)'>Tải thêm</button>";
                                }
                            };break;
                            case "custom-view" : {
                                if($ct != ""){
                                    switch ($ct){
                                        case "xem-nhieu" : {
                                            echo "<button onclick='Load_More_Prd(``,``, ``,`xem-nhieu`)'>Tải thêm</button>";
                                        };break;
                                        case "giam-gia" : {
                                            echo "<button onclick='Load_More_Prd(``,``, ``,`giam-gia`)'>Tải thêm</button>";
                                        };break;
                                        case "gia-cao-thap" : {
                                            echo "<button onclick='Load_More_Prd(``,``, ``,`gia-cao-thap`)'>Tải thêm</button>";
                                        };break;
                                        case "gia-thap-cao" : {
                                            echo "<button onclick='Load_More_Prd(``,``, ``,`gia-thap-cao`)'>Tải thêm</button>";
                                        };break;
                                    }
                                }
                            };break;
                            case "gia" : {
                                if($price != "" && is_numeric($_GET['from'])){
                                    echo "<button onclick='Load_More_Prd(``,".$price.")'>Tải thêm</button>";
                                }
                            };break;
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="loadding_line">
    <div class="pulse"></div>
</div>