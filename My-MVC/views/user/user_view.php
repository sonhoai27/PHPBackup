<?php
$TITLE_PAGE = "DQWatch - User";
$META_TYPE = "";
$META_URL = "";
$META_IMAGE = "";
$META_DESC = "";
require_once (__SITE_PATH.'/views/'.'init'.'/'.'head.php');
require_once (__SITE_PATH.'/views/init/header.php');
?>
<div class="col-10 primary_content">
	<div class="row">
		<div class="col-12 col-sm-6 t_1 a_m_t">
            <p>Tài khoản</p>
        </div>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="scms_user_info card_view">
				<h3>Thay đổi email</h3>
				
				<div class="scms_spacer"></div>
				<label for="key_search">Email cũ</label>
				<input class="ipt ipt_search" type="text" placeholder="Email cũ" id="key_search" name="old-email">
				
				<div class="scms_spacer"></div>
				
				<label for="key_search">Email mới</label>
				<input class="ipt ipt_search" type="text" placeholder="Email mới" id="key_search" name="new-email">
				
				<div class="scms_spacer"></div>
				<span class="btn btn_sm btn_default">Lưu</span>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="scms_user_info card_view">
				<h3>Thay đổi mật khẩu</h3>
				
				<div class="scms_spacer"></div>
				<label for="key_search">Mật khẩu cũ</label>
				<input class="ipt ipt_search" type="text" placeholder="Mật khẩu cũ" id="key_search" name="old-pass">
				
				<div class="scms_spacer"></div>
				
				<label for="key_search">Mật khẩu mới</label>
				<input class="ipt ipt_search" type="text" placeholder="Mật khẩu mới" id="key_search" name="new-pass">
				
				<div class="scms_spacer"></div>
				<span class="btn btn_sm btn_default">Lưu</span>
			</div>
		</div>
		
	</div>
</div>

