<?php
    $TITLE_PAGE = "Admin - Hãng";
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
            <p>Danh sách hãng</p>
        </div>
        <div class="col-12  col-sm-6 scms_action a_m_t">
            <span class="btn btn_default btn_sm" onclick="btnbrandAdd()">Thêm mới</span>
        </div>
        <div class="col-12 scms_tasks">
            <div class="item">
                <div id="sh_search_bar">
                    <input
                            class="ipt ipt_search"
                            type="text"
                            placeholder="Tìm theo tên"
                            id="key_search"
                            name="search"
							onkeyup="fastBrandSearch()"
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
							<th>#</th>
							<th>Tên</th>
							<th>Ngày tạo</th>
							<th>Thiết lập</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i = 1;
							foreach($listBrands['brands'] as $item){?>
								<tr>
									<td><?=$i++?></td>
									<td id="brd_<?=$item['id_brand']?>" onclick="brandDetail(<?=$item['id_brand']?>)"><?=$item['name_brand']?></td>
									<td><?=$item['created_date']?></td>
									<td><span>Xóa</span></td>
								</tr>
							<?php }
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