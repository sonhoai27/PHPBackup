<?php
$TITLE_PAGE = "DQWatch - Login";
$META_TYPE = "";
$META_URL = "";
$META_IMAGE = "";
$META_DESC = "";
require_once (__SITE_PATH.'/views/'.'init'.'/'.'head.php');
?>
<div class="col-12" style="position: relative;height: 100%;">
	<div class="row">
		<div class="col-4"></div>
		
		<div class="col-4 scms_login">
			<div class="content">
				
				<ul class="nav-tab normal-tab full header-tab">
					<li class="login <?=$_GET['tb'] == "login" ? "active":""?>"><p>Đăng Nhập</p></li>
					<li class="register <?=$_GET['tb'] == "register" ? "active":""?>"><p>Đăng Ký</p></li>
				</ul>
				<div class="content-tab scms_login_content">
					<div class="child-tab login <?=$_GET['tb'] == "login" ? "active":""?>">
						<input placeholder="Email" id="userLo" type="email" class="ipt ipt_search">
						<input placeholder="Mật khẩu" id="passLo" type="password" class="ipt ipt_search">
						<span onclick="userLogin()" class="btn btn_default">Đăng nhập</span>
						<p>Chưa có tài khoảng? Đăng ký.</p>
					</div>
					<div class="child-tab register <?=$_GET['tb'] == "register" ? "active":""?>">
						<input placeholder="Email" id="userRe" type="email" class="ipt ipt_search">
						<input placeholder="Mật khẩu" id="passRe" type="password" class="ipt ipt_search">
						<span onclick="userRegister()" class="btn btn_default">Đăng ký</span>
						<p>Có tài khoảng? Đăng nhập.</p>
					</div>
				</div>
			</div>
			
		</div>
		<div class="col-4"></div>
	</div>
</div>