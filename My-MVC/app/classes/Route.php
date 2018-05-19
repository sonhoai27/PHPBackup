<?php
    class Route {
      private $path;
      private $args = array();
      public $file;
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
        $this->getController();

        if(!is_readable($this->file)){
          $this->file = $this->path.'/404Controller.php';
          $this->controller = 'error404';
        }

        //inclue file controller
        include $this->file;

        $class = $this->controller.'Controller';
        $controller = new $class;

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

      private function getController(){
        $route = (empty($_GET['url'])) ? "" : $_GET['url'];
        if(empty($route)){
          $route = 'index';//nếu ko có cái nào thì mặc định là home
        }else{
          $parts = explode("/", $route);
          $this->controller = $parts[0]; //gán controller, mặc định controller/action/...
          if(isset($parts[1])){
            $this->action = $parts[1];//nếu có action
          }
          //nếu có các thành phần sau action
          if(isset($parts[2])){
            $countParam = count($parts);
            $k = 1;
            $param = array();
            for($i = 2; $i < $countParam; $i++){
              $param[$k++] = $parts[$i];
            }
            $this->args = $param;
          }
        }
        if(empty($this->controller)){
          $this->controller = 'index';
        }

        if(empty($this->action)){
          $this->action = 'index';
        }

        $this->file = $this->path.'/'.$this->controller.'Controller.php';
      }
    }
?>
