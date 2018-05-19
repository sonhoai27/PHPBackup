<div class="col-sm-12" style="position: fixed;z-index: 2;top: 0;left: 0;right: 0;">
    <div class="row sh_menu_main">
        <div class="col-sm-3">
            <p class="btnPrimaryMenu"></p>
        </div>
        <div class="col-sm-6">
            <input type="text" placeholder="Tìm nhanh sản phẩm" id="input-search">
        </div>
        <div class="col-sm-3 sh_account">
            <p><?=isset($_SESSION['userEmail'])?$_SESSION['userEmail']:""?></p>
            <p></p>
        </div>
    </div>
</div>
<div class="col-12">
    <div class="row">
        <div class="col-sm-2 sh_menu_left">
            <div class="list_item">
                <p>Trang chủ</p>
                <div class="item">
                    <p><a href="<?=BASE_URL?>">Tổng quan</a></p>
                    <p><a href="">Thông báo</a></p>
                </div>
            </div>
            <div class="list_item">
                <p>Cửa hàng</p>
                <div class="item">
                    <p><a href="<?=BASE_URL."shop/order_manager"?>">Đơn hàng</a></p>
                    <p><a href="<?=BASE_URL."shop/contact_manager"?>">Liên hệ</a></p>
                    <p><a href="<?=BASE_URL."shop/am_manager"?>">Mua hàng Mỹ</a></p>
                </div>
            </div>
            <div class="list_item">
                <p>Sản phẩm</p>
                <div class="item">
                    <p><a href="<?=BASE_URL."product"?>">Tất các sản phẩm</a></p>
                    <p><a href="<?=BASE_URL."product/add_new"?>">Thêm sản phẩm mới</a></p>
                    <p><a href="<?=BASE_URL."brand"?>">Hãng sản phẩm</a></p>
                </div>
            </div>
            <div class="list_item">
                <p>Thiết lập</p>
                <div class="item">
                    <p><a href="<?=BASE_URL."user"?>"">Tài khoản</a></p>
                    <p><a href="">Điều khoản</a></p>
                    <p><a href="">Cài đặt</a></p>
                </div>
            </div>
        </div>