<?php

/*** auto load model classes ***/
function __autoload($class_name) {
    // $filename = strtolower($class_name) . '.class.php';
    // $file = __SITE_PATH . '/model/' . $filename;

    // if (file_exists($file)){
		// include_once ($file);
    // }    
	$aes = __SITE_PATH.'/includes/AES.php';
	if (file_exists($aes)){
		include_once ($aes);
    }
	
}
function AES256_encrypt($key,$data){		
	$aes = new AES($data, $key, 256);		
	return rtrim(strtr(base64_encode($aes->encrypt()), '+/', '-_'), '='); 
}

function AES256_decrypt($key, $data){	
	$aes = new AES(base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)), $key, 256);
	return $aes->decrypt();
}

?>