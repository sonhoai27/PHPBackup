<?php
$TITLE_PAGE = "DQWatch - Thêm sản phẩm";
$META_TYPE = "";
$META_URL = "";
$META_IMAGE = "";
$META_DESC = "";
require_once (__SITE_PATH.'/views/'.'init'.'/'.'head.php');
?>
<?php require_once (__SITE_PATH.'/views/init/header.php')?>
<div class="col-sm-10 primary_content">
    <form name="addNewPrd" onsubmit="return checkSubmitPrdForm()" action="<?php echo BASE_URL.'product/progress_add_prd'?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 t_1 a_m_t">
                <p>Thêm sản phẩm mới</p>
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
            <div class="col-sm-9 content_add content-tab">
                <div class="child-tab active">
                    <div class="input_group">
                        <p>Thông tin sản phẩm</p>
                        <div class="item">
                            <label for="" class="red-30">Tên sản phẩm</label>
                            <input type="text" placeholder="Tên sản phẩm" name="name-prd" class="ipt" id="input-name-prd">
                        </div>
                        <div class="item second">
                            <label for="">Alias sản phẩm</label>
                            <input type="text" placeholder="Alias sản phẩm" class="ipt" id="input-alias-prd" name="alias-prd">
                        </div>
                        <div class="item">
                            <label for="" class="red-30">Mã sản phẩm</label>
                            <input type="text" placeholder="Mã sản phẩm" class="ipt" name="ksu-prd">
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Hãng sản xuất</p>
                        <div class="item">
                            <label for="">Chọn hãng</label>
                            <select name="brand-prd" id="" class="ipt">
                                <?php foreach ($list_brands['brands'] as $brand){?>
                                    <option value="<?=$brand['id_brand']?>"><?=$brand['name_brand']?></option>
                                <?php  } ?>
                            </select>
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Giá và giảm giá</p>
                        <div class="item">
                            <label for="" class="red-30">Giá gốc</label>
                            <input type="text" placeholder="Giá gốc" class="ipt" name="price-prd" id="input-price-prd">
                        </div>
                        <div class="item second">
                            <label for="">Khuyến mãi</label>
                            <input type="text" placeholder="Khuyến mãi" class="ipt" name="sale-off-prd" id="input-sale-off-prd">
                            <p class="title_noty_sale"></p>
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
                            <input type="text" placeholder="Kích thước" class="ipt" name="size-prd">
                        </div>
                        <div class="item second">
                            <label for="">Giới tính</label>
                            <select name="sex-prd" id="" class="ipt">
                                <?php foreach ($list_sex as $sex){?>
                                    <option value="<?=$sex['id_sex']?>"><?=$sex['name_sex']?></option>
                                <?php  } ?>
                            </select>
                        </div>
                        <div class="item">
                            <label for="">Màu sắc</label>
                            <input type="text" placeholder="Màu sắc" class="ipt" name="color-prd">
                        </div>
                    </div>
                    <div class="input_group">
                        <p>Giới thiệu chung</p>
                        <div class="item full">
                            <textarea name="info-prd" id="" placeholder="Thông tin sản phẩm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="child-tab">
                    <div class="img_upload">
                        <input type="file" name="img-prd[]" multiple id="img-prd" class="input_file">
                        <label for="file" class="btn-upload">
                            <span>Chọn hình</span>
                        </label>
                    </div>
                    <div class="content_file_name_upload">

                    </div>
                </div>
            </div>
            <div class="col-sm-3 sidebar_add_new_prd">
                <div class="card_view reset_padding">
                    <p class="t_h_2">Đăng sản phẩm</p>
                    <div class="content">
                        <span>Còn hàng: </span>
                        <select name="public-prd">
                            <option value="0">Còn hàng</option>
                            <option value="1">Hết hàng</option>
                        </select>
                        <p class="cmt_s">Việc lựa chọn "hết hàng",
                            sản phẩm vẫn hiện ra cho khách hàng
                            nhưng chỉ có thể liên hệ để mua.</p>
                        <input class="btn btn_action" type="submit" value="Thêm mới">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
