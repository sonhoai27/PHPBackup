<?php
    class apiRoute {
      private $path;
      private $args = array();
      public $controller;
      public $action;

      function setPath($path){
        if(is_dir($path)){
          $this->path = $path;
        }else{
          throw new Exception("ERROR".$path);
        }
      }
      public function loader(){
		$route =  $_SERVER['REQUEST_URI'];
		$parts = explode("/", $route);
        if(isset($parts[3]) && $parts[3] != ""){
            $this->action = $parts[3];
        }
        if(isset($parts[4])){
            $countParam = count($parts);
            $k = 1;
            $param = array();
            for($i = 4; $i < $countParam; $i++){
              $param[$k++] = $parts[$i];
            }
            $this->args = $param;
        }
        if(empty($this->action)){
          $this->action = 'index';
        }
		
        include_once $this->path."\\".'apiController.php';
        $controller = new apiController();

        if(!is_callable(array($controller, $this->action))){
          $action = 'index';
        }else{
          $action = $this->action;
        }
        if(!empty($this->args)){
          $controller->$action($this->args);
        }else{
			$controller->$action();
        }

      }
    }
?>
