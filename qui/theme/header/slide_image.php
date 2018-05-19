<div class="col-xs-12 slide-products">
    <div class="row slider_banner_ads">
          <div class="container" style="padding-left: 0px">
              <div class="col-sm-6 slider_banner_title">
                  <p>Chào mừng đến với</p>
                  <p>ĐQWatch - HÀNG HIỆU AUTHENTIC</p>
                  <div class="slider_btn_shop">
                      <button onclick="window.location.href='./dong-ho'">mua ngay</button>
                  </div>
              </div>
            <div class="col-sm-6">
              <div class="owl-carousel o-c-banner owl-theme owl-loaded owl-drag">
                    <div class="item">
                        <img src="./public/cdn/Bulova.png" alt="" class="img img-responsive">
                    </div>
                    <div class="item">
                        <img src="./public/cdn/citizen.png" alt="" class="img img-responsive">
                    </div>
                    <div class="item">
                        <img src="./public/cdn/omega.png" alt="" class="img img-responsive">
                    </div>
                    <div class="item">
                        <img src="./public/cdn/rolex.png" alt="" class="img img-responsive">
                    </div>
              </div>
            </div>
          </div>
     </div>
     <script>
        $(document).ready(function() {
            var owl = $('.o-c-banner');
            owl.owlCarousel({
                items: 1,
                loop:true,
                margin:0,
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
                        items:1,
                        nav:false,
                        loop:true
                    },
                    1000:{
                        items:1,
                        nav:true,
                        loop:true,
                        dots: false,
                    }
                }
            });
        })
    </script>
</div>