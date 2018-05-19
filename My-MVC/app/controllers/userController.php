<?php

	class userController extends BaseController{
		public function index(){
			if(!isset($_SESSION['userId'])){
				$this->redirect("user", "login?tb=login");
			}else{
				$this->view->show("user_view", "user");
			}
		}
		public function register(){
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				$user = array(
					"user_email"=>$_POST['user'],
					"user_password"=>md5($_POST['pass'])
				);
				echo ($this->model->get("userModel")->add($user) != 0 ? 1 : 0);
			}
		}
		public function login(){
			//echo AES256_encrypt("SON", "SON");
			if((!isset($_GET['tb']) && !isset($_SESSION['userId']))){
				$this->redirect("user", "login?tb=login");
			}else if(isset($_GET['tb']) && !isset($_SESSION['userId'])){
				$this->view->show("login_view","user");
				$this->view->show("foot", "init");
			}else if(isset($_SESSION['userId'])){
				$this->redirect("user");
			}
		}
		
	}