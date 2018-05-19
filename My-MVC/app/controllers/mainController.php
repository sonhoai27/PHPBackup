<?php
	class mainController extends BaseController{
		public function index(){}
		public function head(){
			
		}
		public function foot($arr = array()){
			$this->view->show("foot", "init");
			require_once (__SITE_PATH.'/views/ex/struchtml.php');
		}
	}
