<?php
	$link = "http://mp3.zing.vn/bai-hat/Vo-Nguoi-Ta-Phan-Manh-Quynh/ZW7WBZBI.html";
	$tach_chuoi = explode("/", $link);
	$get_id = str_replace(".html", "", $tach_chuoi[count($tach_chuoi) -1]);
	$url = "http://api.mp3.zing.vn/api/mobile/song/getsonginfo?requestdata={\"id\":\"$get_id\"}";
  	$json = json_decode(file_get_contents($url), true);
  	echo $json;
?>