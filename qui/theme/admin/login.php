<?php
  $pass_code_login = 0;
  if(!isset($_POST['sh_form_admin_submit'])){
    $pass_code_ran = mt_rand(10000, 99999);
    $pass_code_login = $pass_code_ran;
  }else{
    $email = $_POST['email_admin'];
    $pass = $_POST['password_admin'];
    $passcode = $_POST['passcode_admin'];
    if($email == "dinh.qui94@gmail.com" && $pass == "123123" && $passcode == $pass_code_login){
      $_SESSION['login'] = "OK";
      header("Location: ./admin");
    }else{
      echo "That Bai";
    }
}
?>
<title>Đăng Nhập</title>
<div class="container sh_login">
  <div class="row">
    <div class="col-xs-4"></div>
    <div class="col-xs-4 sh_content_form_login">
      <h1 class="text-center sh_title_login">Đăng Nhập</h1>
      <form class="sh_form_login" method="post" accept-charset="utf-8">
        <input type="email" name="email_admin" placeholder="Nhập Id Quản Trị">
        <input type="password" name="password_admin" placeholder="Nhập Mật Khẩu">
        <div class="sh_content_passcode_login">
          <?="MÃ: "."QW".$pass_code_login?>
        </div>
        <input type="text" name="passcode_admin" placeholder="Nhập Mã Bảo Mật">
        <input type="submit" name="sh_form_admin_submit" value="Đăng Nhập">
      </form>
    </div>
    <div class="col-xs-4"></div>
  </div>
</div>

</div>
</div>
