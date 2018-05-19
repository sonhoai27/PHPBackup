<?php
	session_start();
	class apiController{
		protected $model;
		protected $view;
		
		function apiController(){
			$this->model = BaseModel::getInstance();
		}
		public function index(){
			
		}
	}
