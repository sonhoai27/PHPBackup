<?php
$TITLE_PAGE = "Admin - Trang Chủ";
$META_TYPE = "";
$META_URL = "";
$META_IMAGE = "";
$META_DESC = "";
require_once (__SITE_PATH.'/views/'.'init'.'/'.'head.php');
?>
<?php require_once (__SITE_PATH.'/views/init/header.php')?>
<div class="col-sm-10 primary_content">
    <form id="form_info_prd"  action="<?php echo BASE_URL.'product/progress_edit_prd/'.$prd['id_prd']."/0"?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 t_1 a_m_t">
                <p>Chi tiết sản phẩm</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="nav-tab normal-tab">
                    <li class="active"><p>Thông tin chung</p></li>
                    <li><p>Giới thiệu</p></li>
                    <li><p>Hình sản phẩm</p></li>
                </ul>
            </div>
            <div class="col-sm-8 content_add content-tab">
                <div class="child-tab active">
                    <div class="input_group">
                        <p>Thông tin sản phẩm</p>
                        <div class="item">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" placeholder="Tên sản phẩm" class="ipt" name="name-prd" value="<?=$prd['name_prd']?>" id="input-name-prd">
                        </div>
                        <div class="item second">
                            <label for="">Alias sản phẩm</label>
                            <input type="text" placeholder="Alias sản phẩm" class="ipt" name="alias-prd" value="<?=$prd['alias_prd']?>" id="input-alias-prd">
                        </div>
                        <div class="item">
                            <label for="">Mã sản phẩm</label>
                            <input type="text" placeholder="Mã sản phẩm" class="ipt" name="ksu-prd" value="<?=$prd['ksu_prd']?>">
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Hãng sản xuất</p>
                        <div class="item">
                            <label for="">Chọn hãng</label>
                            <select name="brand-prd" id="" class="ipt">
                                <?php foreach ($list_brands['brands'] as $brand){
                                    if($prd['brand_id_prd'] == $brand['id_brand']){?>
                                        <option value="<?=$brand['id_brand']?>" selected><?=$brand['name_brand']?></option>
                                    <?php }else{?>
                                        <option value="<?=$brand['id_brand']?>"><?=$brand['name_brand']?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Giá và giảm giá</p>
                        <div class="item">
                            <label for="">Giá gốc</label>
                            <input type="text" placeholder="Giá gốc" class="ipt" name="price-prd" value="<?=$prd['price_prd']?>" id="input-price-prd">
                        </div>
                        <div class="item second">
                            <label for="">Khuyến mãi</label>
                            <input type="text" placeholder="Khuyến mãi" class="ipt" name="sale-off-prd" value="<?=$prd['sale_off_prd']?>" id="input-sale-off-prd">
                            <p class="title_noty_sale">
                                <?php
                                echo ($prd['price_prd'] - ($prd['price_prd'] * $prd['sale_off_prd'])/100);
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Số lượng sản phẩm trong kho</p>
                        <div class="item">
                            <label for="">Số lượng</label>
                            <input type="text" placeholder="số lượng" class="ipt" name="num-prd">
                        </div>
                    </div>

                </div>
                <div class="child-tab">
                    <div class="input_group">
                        <p>Kích thước, màu sắc, giới tính</p>
                        <div class="item">
                            <label for="">Kích thước</label>
                            <input type="text" placeholder="Kích thước" class="ipt" name="size-prd" value="<?=$prd['size_prd']?>">
                        </div>
                        <div class="item second">
                            <label for="">Giới tính</label>
                            <select name="sex-prd" id="" class="ipt">
                                <?php foreach ($list_sex as $sex){
                                    if($prd['sex_prd'] == $sex['id_sex']){
                                        echo "<option value=".$sex['id_sex']." selected>".$sex['name_sex']."</option>";
                                    }else{
                                        echo "<option value=".$sex['id_sex'].">".$sex['name_sex']."</option>";
                                    }
                                } ?>
                            </select>
                        </div>
                        <div class="item">
                            <label for="">Màu sắc</label>
                            <input type="text" placeholder="Màu sắc" class="ipt" name="color-prd" value="<?=$prd['color_prd']?>">
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Giới thiệu chung</p>
                        <div class="item full">
                            <textarea name="info-prd" id="" placeholder="Thông tin sản phẩm"><?=$prd['info_prd']?></textarea>
                        </div>
                    </div>
                </div>
                <div class="child-tab">
                    <ul class="scms_img_upload">

                            <?php
                                $list_img = explode(",", $prd['Array_Img']);
                                foreach ($list_img as $item){
                                    echo '<li class="action">'; ?>
                                    <?php $img = explode(":", $item);?>
                                    <input type="file" name="input_img_edit" id="input-img-edit">
                                    <?php if(explode(".", $img[1])[2] == "svg"){
                                        echo "<img src='".$img[1]."' data-img='1-".$img[0]."-".$prd['id_prd']."'>";
                                    }else{
                                        echo "<img src='".BASE_URL."crop_image/?src=".BASE_URL.$img[1]."&w=250&h=250' data-img='0-".$img[0]."-".$prd['id_prd']."'>";
                                    }
                                    echo '<div class="the_img_upload_action">';
                                    echo '<span class="edit_img">Sửa</span>';
                                    echo '<span class="delete_img">Xóa</span>';
                                    echo '</div>';
                                    echo "</li>";
                                }
                            ?>
                        <li>
                            <img src='<?=BASE_URL?>./public/images/cdn/icon/no-image.svg' alt="Image">
                            <p class="add_img"><span><?=$prd['id_prd']?></span></p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4 sidebar_add_new_prd">
                <div class="card_view reset_padding">
                    <p class="t_h_2">Cập nhật sản phẩm</p>
                    <div class="content">
                        <span>Còn hàng: </span>
                        <select name="public-prd">
                            <?php
                            if($prd['public_prd'] == 0){?>
                                <option value="0" selected>Còn hàng</option>
                                <option value="1">Hết hàng</option>
                            <?php }else { ?>
                                <option value="0">Còn hàng</option>
                                <option value="1" selected>Hết hàng</option>
                            <?php }?>

                        </select>
                        <p class="cmt_s">Việc lựa chọn "hết hàng",
                            sản phẩm vẫn hiện ra cho khách hàng
                            nhưng chỉ có thể liên hệ để mua.</p>
                        <input class="btn btn_action btn_xs" type="submit" value="Cập nhật & thoát">
                        </form>
                        <p class="btn btn_action btn_xs" onclick="updateFast('<?=$id_prd?>')">Cập nhật</p>
                        <a class="btn btn_warning btn_xs" href="<?=BASE_URL."product"?>">Thoát</a>
                    </div>

                </div>
            </div>
        </div>

</div>