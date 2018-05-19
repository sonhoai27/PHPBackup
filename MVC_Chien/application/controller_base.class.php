<?php
Abstract Class baseController {

/*
 * @registry object
 */
protected $registry;
protected $model;
protected $view;

function __construct($registry) {
	$this->registry = $registry;
	$this->model = baseModel::getInstance();
	$this->view  = baseView::getInstance();
}
function render($controller,$name){
	$path = __SITE_PATH . '/controller' . '/' . $controller  . 'Controller.php';

	if (file_exists($path) == false)
	{
		throw new Exception('Template not found in '. $path);
		return false;
	}

	include ($path); 
	$class = $controller.'Controller';
	$function = new $class($this->registry);
	$action = explode('/',$name);
	if(count($action)>1){
		for($i=1;$i<count($action);$i++){
			$arr[$i]=$action[$i];
		}
		$function->$action[0]($arr);	
	}else{
		$function->$action[0]();
	}
}
function redirect($controller,$name){
	echo "<script>window.location='".BASEURL."/".$controller."/".$name."';</script>";
}
/**
 * @all controllers must contain an index method
 */
abstract function index();
}

?>
