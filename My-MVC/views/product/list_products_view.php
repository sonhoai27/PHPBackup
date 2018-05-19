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
    <div class="row">
        <div class="col-12 col-sm-6 t_1 a_m_t">
            <p>Danh sách các sản phẩm</p>
        </div>
        <div class="col-12  col-sm-6 scms_action a_m_t">
            <span class="btn btn_default btn_sm"><a href="<?= BASE_URL . "product/add_new" ?>">Thêm mới sản phẩm</a></span>
<!--            <form action="--><?//= BASE_URL ."/product/delete_prd/"?><!--" method="post" style="display: inline-block;" id="submit-delete-prd">-->
<!--                <input value="" type="text" name="list-id" id="list-id-prd" style="display: none;">-->
<!--            </form>-->
            <input value="" type="text" name="list-id" id="list-id-prd" style="display: none;">
            <button class="btn btn_danger btn_sm" id="btn-submit-delete-prd"><span>Xóa các sản phẩm</span></button>
        </div>
        <div class="col-12 scms_tasks">
            <div class="item">
                <select id="scms_filter_brand">
                    <option value="">Hãng</option>
                    <?php
                        foreach ($list_brands['brands'] as $brand){
                            echo '<option value="'.$brand['alias_brand'].'">'.$brand['name_brand'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="item">
                <select id="scms_filter_date">
                    <option value="">Lọc theo</option>
                    <option value="desc">Mới đến cũ</option>
                    <option value="asc">Cũ đến mới</option>
                </select>
            </div>
            <div class="item">
                <div id="sh_search_bar">
                    <input
                            class="ipt ipt_search"
                            type="text"
                            placeholder="Tìm theo tên hoặc KSU"
                            id="key_search"
                            name="search"
							onkeyup="fastSearch()"
                    >
                    <span class="btn btn_default">Tìm</span>
                </div>
            </div>

        </div>
        <div class="col-12 scms_list_prd">
            <div class="content">
				<table class="table">
					<thead>
						<tr class="">
							<th>#<?=count($prds['list_prds'])?></th>
							<th>Hình</th>
							<th class="f_action" width="30%">Tên sản phẩm</th>
							<th class="f_action">Giá</th>
							<th>Thiết lập</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($prds['list_prds'] as $prd){?>
							<tr class="item item_<?=$prd['id_prd']?>">
								<td><input type="checkbox"
										   name="prd_item_<?=$prd['id_prd']?>"
										   id="prd_<?=$prd['id_prd']?>"
										   value="<?=$prd['id_prd']?>"
										   onclick="DeleteProductId(<?=$prd['id_prd']?>)"
									></td>
								<?php if(explode(".", $prd['src_prd'])[2] == "svg"){
									echo "<td><img src='".$prd['src_prd']."'></td>";
								}else{?>
									<td><img src="<?=BASE_URL."crop_image/?src=".BASE_URL.$prd['src_prd']?>&w=50&h=50" alt="Image"></td>
								<?php }?>

								<td><a href="
									<?=BASE_URL.'product/detail/'.$prd['id_prd']?>">
										<?=$prd['name_prd']?></a>
								</td>
								<td><?=number_format($prd['price_prd'])?> VNĐ</td>
								<td>
									<?php
										if($prd['public_prd'] == 0){
											echo "<span class='btn btn_warning btn_xs' id='p2_a_".$prd['id_prd']."' 
													onclick='productPublic(1,".$prd['id_prd'].")'>
													Hết hàng
												</span>";
										}else{
											echo "<span class='btn btn_info btn_xs' id='p2_a_".$prd['id_prd']."' 
													onclick='productPublic(0,".$prd['id_prd'].")'>
													Còn hàng
												</span>";
										}
									?> 
								</td>
							</tr>
						<?php }
						if(count($prds['list_prds']) == 0){
							echo "<h5>Không có sản phẩm nào!</h5>";
						}
						?>
					</tbody>
				</table>
                <div class="scms_content_pg">
                    <?=$phanTrang?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#scms_filter_date").change(function(){
        //1 filter, 2 search
        var currentUrl = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&')
        if(window.location.href.indexOf('?') == -1 ){
            window.location.href = window.location.origin+window.location.pathname+'?date='+$(this).val()
        }
        window.location.href = (currentUrl[0].slice(0, currentUrl[0].indexOf('=')) == 'page')
            ? ( window.location.origin+window.location.pathname+'?date='+$(this).val()+"&"+currentUrl[0])
            : (window.location.origin+window.location.pathname+'?date='+$(this).val()+(currentUrl[1] == undefined ? "" : "&"+currentUrl[1]))

    })
    $("#scms_filter_brand").change(function(){
        //1 filter, 2 search
        var currentUrl = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&')
        if(window.location.href.indexOf('?') == -1 ){
            window.location.href = window.location.origin+window.location.pathname+'?brand='+$(this).val()
        }
        window.location.href = (currentUrl[0].slice(0, currentUrl[0].indexOf('=')) == 'page')
            ? ( window.location.origin+window.location.pathname+'?brand='+$(this).val()+"&"+currentUrl[0])
            : (window.location.origin+window.location.pathname+'?brand='+$(this).val()+(currentUrl[1] == undefined ? "" : "&"+currentUrl[1]))

    })
</script>