<div class="row">
<div class="col-xs-12 sh_prd_header_btn_action">
    <div class="sh_title_manager_product">
        <h2>Quản lý sản phẩm</h2>
    </div>
    <div class="sh_prd_btn_action">
        <form action="?a=product_c&dir=3" accept-charset="utf-8" method="post">
            <input type="text" id="get_id_prd" name="delete_id_watch" style="display: none">
            <button type="submit" class="sh_action_submit"><p>Xóa</p></button>
        </form>
        <a href="?a=product_c" class="sh_action_link">
            <p>Thêm mới</p>
        </a>
    </div>
</div>
<div class="col-xs-12 sh_prd_option_search">
    <?php 
    if(!isset($_GET['sh_code_search_prd']) && !isset($_GET['sh_key_search_prd'])){?>
        <div class="sh_prd_option_category">
            <select id="sh_filter_brand_prd">
                <option>Theo hãng</option>
                <?php foreach($arr['list_brands'] as $brands){?>
                <option value="<?php echo $brands['alias_brand']?>"><?php echo $brands['name_brand']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="sh_prd_option_category">
            <select id="sh_filter_prd">
                <option>Xem theo</option>
                <option value="giam-gia">Giảm giá</option>
                <option value="asc">Cũ tới mới</option>
                <option value="desc">Mới tới cũ</option>
                <option value="nam">Giới tính Nam</option>
                <option value="nu">Giới tính Nữ</option>
                <option value="unisex">Giới tính Unisex</option>
            </select>
        </div>
    <?php }?>
    <div class="sh_prd_search">
        <select id="sh_box_filter_search_prd">
            <option value="code-prd" selected>Theo mã</option>
            <option value="name-prd">Tìm theo tên</option>
        </select>
        <form method="get" id="sh_search_bar">
            <input type="text" name="sh_code_search_prd" style="display: none" id="sh_input_search_prd"/>
            <input type="text" name="sh_key_search_prd" placeholder="What are you looking for?" id="sh_key_search_prd"/>
            <button type="submit" style="display: none">Tìm</button>
        </form>
    </div>

</div>
<div class="col-xs-12">
    <div class="sh_content_filter_tag">
        <?php
        $hang = isset($_GET['hang']) ? $_GET['hang'] : "";
        $xem = isset($_GET['xem']) ? $_GET['xem'] : "";
        if($hang != "" || $xem != ""){
          echo "Bạn đang xem: <span>".$hang."</span>"." - "."<span>".$xem."</span>";
          echo "<p onclick='Sh_Exit_Filtter_Prd()'>Thoát</p>";
        }
      ?>
    </div>
</div>
<div class="col-xs-12">
    <div class="table-responsive sh_prd_table_manager">
        <table class="sh_table_list_order" width="100%">
            <tr class="sh_border_table">
                <td width="5%"></td>
                <td width="5%">Loại</td>
                <td width="40%">Tên</td>
                <td width="25%" class="show_td_table">Giá</td>
                <td width="20%">Hình</td>
            </tr>
            <?php foreach($arr['list_prds']['list_prds'] as $kq => $value_kq){ ?>

            <tr>
                <td>
                    <input id="prd_<?php echo $value_kq['id_watch']?>" 
			name="prd_item_<?php echo $value_kq['id_watch']?>"
			type="checkbox" class="sh_btn_checkbox" value="<?php echo $value_kq['id_watch']?>"
			onclick="DeleteProductId(<?php echo $value_kq['id_watch']?>)">
                    <label for="prd_<?php echo $value_kq['id_watch']?>" class="sh_checkbox_label"></label>
                </td>
                <td>
                    <?php echo $value_kq['name_sex']?>
                </td>
                <td>
                    <a href="./admin?a=prd_detail&id=<?php echo $value_kq['id_watch']?>">
                        <?php echo $value_kq['name_watch']?>
                    </a>
                </td>
                <td class="show_td_table">
                    <?php echo number_format($value_kq['price_watch']).' VND'?>
                </td>
                <td><img src="./<?php echo $value_kq['content_img']?>" alt="" class="img img-responsive" width="50%"></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php
        $current = NULL;
        $current_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(isset($_GET['trang'])){
            $current = explode("trang", $current_link)[0]."trang=";
        }else{
            $current = $current_link."&trang=";
        }

    ?>
    <div class="sh_pagination p12">
        <ul>
            <li><a href="<?php
            echo $current;
             if(!isset($_GET['trang'])){
                echo 1;
            }else {
                if($_GET['trang'] - 1 == 0){
                    echo 1;
                }else{
                    echo $_GET['trang'] - 1;
                }
            }
            ?>">Trở về</a></li>
            <li><a href="
            <?php echo $current;
                if(!isset($_GET['trang']) && $arr['list_prds']['num_rows'] - 8 <= 0){
                    echo 1;
                }else{
                    if(!isset($_GET['trang']) && $arr['list_prds']['num_rows'] - 8 > 0){
                        echo 2;
                    } 
                }
                if(isset($_GET['trang']) && $arr['list_prds']['num_rows'] - $_GET['trang']*8 > 0){
                    echo $_GET['trang'] + 1;
                }else{
                    if(isset($_GET['trang']) && $arr['list_prds']['num_rows'] - $_GET['trang']*8 <= 0){
                        echo $_GET['trang'];
                    }
                }
            ?>">Tiếp theo</a></li>
        </ul>
    </div>
</div>
</div>
</div>
</div>
<script>
// var check_btn_delete = false;
var array_id = []

function DeleteProductId(id) {
    console.log(id)
    var text_id = "";
    if (document.getElementById('prd_' + id).checked == true) {
        array_id.push(id)
        for (var i = 0; i < array_id.length; i++) {
            text_id = text_id + array_id[i] + ","
        }
    } else {
        if (document.getElementById('prd_' + id).checked == false) {
            for (var i = 0; i < array_id.length; i++) {
                if (array_id[i] == id) {
                    for (var j = i; j < array_id.length; j++) {
                        array_id[j] = array_id[j + 1]
                    }
                }
            }
            text_id = "";
            array_id.length--;
            for (var i = 0; i < array_id.length; i++) {
                text_id = text_id + array_id[i] + ","
            }
        }
    }
    document.getElementById('get_id_prd').value = text_id.substr(0, (text_id.length - 1))
}
$(document).ready(() => {
    $("#sh_filter_brand_prd").change(() => {
        var value_brand = $("#sh_filter_brand_prd").find("option:selected").val()
        var link_prd = "&hang="
            //history.pushState("stateObj", "Loc hang", link_prd + value_brand);
        var current_link = window.location.href.split("&")
        if (current_link.length == 1) {
            current_link = current_link[0] + link_prd + value_brand
            window.location = current_link
        } else {


            if ((current_link.length > 1 && current_link[1].split("=")[0] == "xem")) {
                current_link = current_link[0] + link_prd + value_brand + '&' + current_link[1]
                window.location = current_link
            } else {
                if(current_link.length > 2 && current_link[2].split("=")[0] == "xem"){
                    current_link = current_link[0] + link_prd + value_brand + '&' + current_link[2]
                    window.location = current_link
                }else{
                    if(current_link.length > 1 && current_link[1].split("=")[0] != "xem"){
                        current_link = current_link[0] + link_prd + value_brand
                        window.location = current_link
                    }
                }
               
            }
        }
    })
    $("#sh_filter_prd").change(() => {
        var value_filter = $("#sh_filter_prd").find("option:selected").val()
        var link_filter = "&xem="
            //history.pushState("stateObj", "Loc hang", link_prd + value_brand);
        var current_link = window.location.href.split("&")
        if (current_link.length == 1) {
            current_link = current_link[0] + link_filter + value_filter
            window.location = current_link
        } else {
            if (current_link.length > 1 && current_link[1].split("=")[0] == "hang") {
                current_link = current_link[0] + '&' + current_link[1] + link_filter + value_filter
                window.location = current_link
            } else {
               if(current_link.length > 1 &&  current_link[1].split("=")[0] != "hang"){
                current_link = current_link[0] + link_filter + value_filter
                window.location = current_link
               }
            }
        }
    })
})
$(window).on('load', function() {
    $("#sh_input_search_prd").val($("#sh_box_filter_search_prd").val())
});
$(document).ready(()=> {
    $("#sh_box_filter_search_prd").click(()=> {
        $("#sh_input_search_prd").val($("#sh_box_filter_search_prd").val())
    })
})

var code_search_product = ""
$(window).on('load', function() {
  code_search_product = $("#sh_box_filter_search_prd").val()
});
$(document).ready(() => {
  var value_search = "";
  $("#sh_box_filter_search_prd").click(() => {
      value_search = $("#sh_key_search_prd").val()
      code_search_product = $("#sh_box_filter_search_prd").val()
      $("#sh_search_bar").attr('action', './admin/san-pham.html' +"?sh_code_search_prd="+code_search_product + '&sh_key_search_prd=' + value_search)
  })
  $("#sh_search_bar").keyup(function(e) {
      e.preventDefault()
      value_search = $("#sh_key_search_prd").val()
      $("#sh_search_bar").attr('action', './admin/san-pham.html'  +"?sh_code_search_prd="+code_search_product + '&sh_key_search_prd=' + value_search)
  })
})
</script>
</div>