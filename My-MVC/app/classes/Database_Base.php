<?php
class BaseModel {
	private static $instance;
	function __construct() {
		
    }
    public static function getInstance() {
		if (!self::$instance)
		{	
			self::$instance = new BaseModel();
		}
		return self::$instance;
	}
	public function get($name, $custom =""){
	    $custom = empty($custom) ? "" : $custom."/";
		$file = __SITE_PATH.'/model/'.$custom.str_replace("model","",strtolower($name))."Model.php";
		
		if(file_exists($file))
		{
            include_once ($file);
			$class = str_replace("model","",strtolower($name))."Model";
			return new $class;
		}		
		return NULL;
	}
	function __destruct() {
	}
}