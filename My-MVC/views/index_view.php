<?php
    $TITLE_PAGE = "Admin - Trang Chủ";
    $META_TYPE = "";
    $META_URL = "";
    $META_IMAGE = "";
    $META_DESC = "";
    require_once (__SITE_PATH.'/views/'.'init'.'/'.'head.php');
?>
<?php require_once (__SITE_PATH.'/views/init/header.php')?>
<div class="col-sm-10 sh_content primary_content">
    <div class="row">
        <div class="col-12 t_1">
            <p>Bảng tin</p>
        </div>
        <div class="col-12">
            <div class="card_view">
                <div class="title_card_view">
                    <h4>Chào mừng bạn đến với sCMS</h4>
                    <p>Chúng tôi đã tập hợp sẵn một số liên kết để bạn có thể bắt đầu ngay</p>
                </div>
                <div class="row scms_home_post">
                    <div class="col-4 item">
                        <p>Hãy Bắt Đầu</p>
                        <span class="btn btn_default"><a href="">Tùy biến trang mạng của bạn</a></span>
                    </div>
                    <div class="col-4 item">
                        <p>Các Bước Tiếp Theo</p>
                        <ul>
                            <li><span><a href="./product/add_new">Tạo mới sản phẩm</a></span></li>
                            <li><span><a href="">Thiết lập điều khoản</a></span></li>
                            <li><span><a href="">Thiết lập tài khoản</a></span></li>
                        </ul>
                    </div>
                    <div class="col-4 item">
                        <p>Các Hành Động Khác</p>
                        <ul>
                            <li><span><a href="">Quản lý đơn hàng</a></span></li>
                            <li><span><a href="">Đơn hàng mỹ</a></span></li>
                            <li><span><a href="">Liên hệ</a></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 scms_content_order_status">
            <div class="card_view">
                <div class="title_card_view">
                    <h4>Thông tin bán hàng</h4>
                </div>
                <div class="content">
                    <ul>
                        <li>10 - Đơn hàng</li>
                        <li>20 - Đặt hàng mỹ</li>
                        <li>0 - Liên hệ</li>
                        <li>10 - Bán hôm nay</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-6 scms_content_list_order">
            <div class="card_view">
                <div class="title_card_view">
                    <h4>Danh sách đơn hàng</h4>
                    <p>Các đơn hàng ngày hôm nay</p>
                </div>
                <div class="content">
                    <ul>
                        <div class="item">
                            <li>Nguyen Van A</li>
                            <li>23:30 - 26-10-2017</li>
                        </div>
                        <div class="item">
                            <li>Nguyen Van A</li>
                            <li>23:30 - 26-10-2017</li>
                        </div>
                        <div class="item">
                            <li>Nguyen Van A</li>
                            <li>23:30 - 26-10-2017</li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>