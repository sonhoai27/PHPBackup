<?php
class Router{
    protected $uri;
    protected $controller;
    protected $action;
    protected $params;

    public function getUri(){
        return $this->uri;
    }
    public function setUri($uri){
        $this->uri = $uri;
    }

    public function getController(){
        return $this->controller;
    }
    public function setcontroller($controller){
        $this->controller = $controller;
    }

    public function getAction(){
        return $this->action;
    }
    public function setAction($action){
        $this->action = $action;
    }

    public function getParams(){
        return $this->params;
    }
    public function setParams($params){
        $this->params = $params;
    }

    public function __construct($uri){
        print_r("OK router was called with: ".$uri);
    }
}