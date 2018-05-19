<div class="container-fluid">
    <div class="row">
       <div class="col-xs-2" id="sh_navigation">
            <div class="sh_navi">
                <ul>
                    <li class="sh_home_tab active"><a href="./admin">Home</a><span class="sh_toggle_menu_left sh_toggle_menu_left_desktop">X</span></li>
                    <li class="sh_order_tab">Đơn Hàng
                      <ul>
                        <li><a href="?a=order&pages=list_order">Danh sách đơn hàng</a></li>
                        <li><a href="?a=order&pages=contacts">Liên hệ</a></li>
                        <li><a href="?a=order&pages=list_order_usa">Mua hàng Mỹ</a></li>
                      </ul>
                    </li>
                    <li class="sh_product_tab"><a href="?a=admin_product">Sản phẩm</a>
                    </li>
                    <li class="sh_setting_tab">Thiết lập<span style="font-size: 12px"></span>
                      <ul>
                        <li><a href="?a=settings">Hãng đồng hồ</a></li>
                        <li><a href="?a=settings&pages=policy">Điều khoản</a></li>
                      </ul>
                    </li>
                    <li class="sh_ads_tab"><a>sFiles</a><span style="font-size: 12px"> (Beta)</span></li>
                </ul>
            </div>
        </div>
<script>
  $(document).ready(()=> {
    $(".sh_ads_tab").click(()=> {
      alert("Bạn không có quyền truy cập")
    })
  })
</script>
